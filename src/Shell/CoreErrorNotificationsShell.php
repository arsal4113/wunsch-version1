<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Mailer\Email;

/**
 * CoreErrorNotification shell command.
 */
class CoreErrorNotificationsShell extends Shell
{

    protected $lastAliveFrequencyInSeconds = 120;

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main()
    {
        parent::initialize();
        $this->loadModel('CoreErrors');
        $this->loadModel('CoreErrorNotificationProfiles');


        $skipNotificationProfileIds = [];
        do {
            $runDate = date('Y-m-d H:i:s');
            $notificationProfile = $this->CoreErrorNotificationProfiles->find()
                ->where(
                    function ($exp) use ($skipNotificationProfileIds) {
                        if (!empty($skipNotificationProfileIds)) {
                            return $exp->notIn('id', $skipNotificationProfileIds);
                        } else {
                            return $exp;
                        }
                    })
                ->andWhere([
                    'is_active' => 1,
                    'next_run <' => $runDate
                ])
                ->order(['next_run' => 'DESC'])
                ->first();

            if (!empty($notificationProfile) && !empty($notificationProfile->email_to)) {
                if ($notificationProfile->is_running == 1) {
                    if ((time() - $notificationProfile->max_execution_time * 60) > strtotime($notificationProfile->last_run)) {
                        $skipNotificationProfileIds[] = $notificationProfile->id;
                        continue;
                    }
                }
                $notificationProfile->is_running = 1;
                $notificationProfile->last_alive = date('Y-m-d H:i:s');
                $this->CoreErrorNotificationProfiles->save($notificationProfile);

                $conditions = [
                    'created >' => $notificationProfile->last_run
                ];
                if (is_numeric($notificationProfile->core_seller_id) && $notificationProfile->core_seller_id > 0) {
                    $conditions['core_seller_id'] = $notificationProfile->core_seller_id;
                }
                if (!empty($notificationProfile->sub_code)) {
                    $conditions['sub_code'] = $notificationProfile->sub_code;
                }
                if (!empty($notificationProfile->code)) {
                    $conditions['code'] = $notificationProfile->code;
                }
                if (!empty($notificationProfile->type)) {
                    $conditions['type'] = $notificationProfile->type;
                }

                $limit = 100;
                $page = 1;

                $lastAliveTime = time();

                $emailErrors = [];
                do {
                    $errors = $this->CoreErrors->find('all')
                        ->where($conditions)
                        ->limit($limit)
                        ->page($page++)
                        ->toArray();

                    if (!empty($errors)) {
                        foreach ($errors as $error) {
                            $emailErrors[] = [
                                'type' => $error->type,
                                'code' => $error->code,
                                'sub_code' => $error->sub_code,
                                'message' => $error->message,
                                'created' => $error->created
                            ];
                        }
                    }
                    if ($lastAliveTime + $this->lastAliveFrequencyInSeconds <= time()) {
                        $notificationProfile->last_alive = date('Y-m-d H:i:s');
                        $this->CoreErrorNotificationProfiles->save($notificationProfile);
                        $lastAliveTime = time();
                    }
                } while (count($errors) == $limit);

                if (!empty($emailErrors)) {
                    $mailer = new Email();
                    $mailer->template('error_notification')
                        ->emailFormat('html')
                        ->to(explode(',', $notificationProfile->email_to))
                        ->subject($notificationProfile->email_subject)
                        ->viewVars(['emailErrors' => $emailErrors]);

                    if (!empty($notificationProfile->email_cc)) {
                        $mailer->addCc(explode(',', $notificationProfile->email_cc));
                    }
                    if (!empty($notificationProfile->email_bcc)) {
                        $mailer->addBcc(explode(',', $notificationProfile->email_bcc));
                    }
                    $mailer->send();
                }

                $notificationProfile->is_running = 0;
                $notificationProfile->last_run = $runDate;
                $notificationProfile->next_run = date('Y-m-d H:i:s', strtotime($runDate) + $notificationProfile->run_interval * 60);
                $this->CoreErrorNotificationProfiles->save($notificationProfile);
            }
        } while (!empty($notificationProfile));
    }
}
