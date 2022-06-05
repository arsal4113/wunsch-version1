<?php
namespace Feeder\Shell;

use Cake\Console\Shell;
use Cake\Http\ServerRequest;
use Feeder\Model\Table\FeederCategoriesTable;

/**
 * RefreshFeederCategories shell command.
 * @property FeederCategoriesTable $FeederCategories
 */
class RefreshFeederCategoriesShell extends Shell
{
    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $this->loadModel('Feeder.FeederCategories');
        $feederCategories = $this->FeederCategories->find()
            ->where(['FeederCategories.use_in_search' => 1, 'FeederCategories.is_invisible' => 0]);

        foreach ($feederCategories as $feederCategory) {
            $this->out(__('Refresh Cache for FeederCategory {0}', $feederCategory->id));
            $this->FeederCategories->getFeederCategoryWithItems(
                $feederCategory->id,
                new ServerRequest(),
                false
            );
        }
    }
}
