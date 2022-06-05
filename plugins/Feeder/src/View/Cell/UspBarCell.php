<?php

namespace Feeder\View\Cell;

use App\Application;
use Cake\View\Cell;
use App\Model\Table\CoreConfigurationsTable;
use Cake\ORM\TableRegistry;

/**
 * UspBar cell
 *
 * @property CoreConfigurationsTable $CoreConfigurations
 * @property Feeder\Model\Table\FeederUspBarTable $FeederUspBar
 */
class UspBarCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    const USP_BAR_Activation_CONFIG_PATH = 'Feeder/FeederUspBar/uspIsActive';
    const USP_BAR_FontColor_CONFIG_PATH = 'Feeder/FeederUspBar/uspFontColor';
    const USP_BAR_BackgroundColor_CONFIG_PATH = 'Feeder/FeederUspBar/uspBackgroundColor';

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $this->loadModel('CoreConfigurations');

        $configs = $this->CoreConfigurations->find()
            ->select([
                'configuration_path',
                'configuration_value'
            ])
            ->whereInList('configuration_path', [
                self::USP_BAR_Activation_CONFIG_PATH,
                self::USP_BAR_FontColor_CONFIG_PATH,
                self::USP_BAR_BackgroundColor_CONFIG_PATH
            ])
            ->cache('usp_bar_config', Application::SHORT_TERM_CACHE);

        $uspIsActive = null;
        $uspFontColor = null;
        $uspBackgroundColor = null;

        foreach ($configs as $config) {
            switch ($config->configuration_path) {
                case self::USP_BAR_Activation_CONFIG_PATH:
                    $uspIsActive = $config->configuration_value;
                    break;
                case self::USP_BAR_FontColor_CONFIG_PATH:
                    $uspFontColor = $config->configuration_value;
                    break;
                case self::USP_BAR_BackgroundColor_CONFIG_PATH:
                    $uspBackgroundColor = $config->configuration_value;
                    break;
            }
        }

        $this->set('uspIsActive', $uspIsActive);

        if ($uspIsActive == true) {
            $this->loadModel('Feeder.FeederUspBar');
            $feederUspBars = $this->FeederUspBar
                ->find('all')
                ->cache('feederUspBar', Application::SHORT_TERM_CACHE);

            $this->set('feederUspBars', $feederUspBars);
            $this->set('uspBackgroundColor', $uspBackgroundColor);
            $this->set('uspFontColor', $uspFontColor);
        }
    }
}
