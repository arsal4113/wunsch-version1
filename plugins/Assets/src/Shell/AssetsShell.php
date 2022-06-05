<?php

namespace Assets\Shell;

use Assets\View\Helper\HtmlHelper;
use Cake\Console\Shell;
use Cake\Core\Plugin;
use Cake\Filesystem\File;
use Cake\Utility\Inflector;

class AssetsShell extends Shell
{

    public function build()
    {
        $this->dispatchShell('plugin assets copy --overwrite');
        $file = new File(HtmlHelper::BUILD_FILE);
        $file->write(time());
        $file->close();
        $this->out(__('Build created'));
    }

    public function remove()
    {
        $this->dispatchShell('plugin assets remove');
        $file = new File(HtmlHelper::BUILD_FILE);
        if ($file->exists()) {
            $file->delete();
        }
        $file->close();
        $this->out(__('Build removed'));
    }

    /**
     * Gets the option parser instance and configures it.
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        $parser->addSubcommand('build', [
            'help' => 'Copy plugin assets to app\'s webroot and create the build file',
        ])->addSubcommand('remove', [
            'help' => 'Remove plugin assets from app\'s webroot and removes the build file.'
        ])->addOptions([
            'minify' => ['help' => 'Minify css/js (build only).', 'boolean' => true],
            'merge' => ['help' => 'Merge css/js (build only).', 'boolean' => true]
        ]);

        return $parser;
    }
}