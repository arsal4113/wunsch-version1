<?php

namespace Ebay\Shell;

use Cake\Console\Shell;

/**
 * Downloader shell command.
 */
class DownloaderShell extends Shell
{

    /**
     * Tasks
     *
     * @var type
     */
    public $tasks = [
        'Ebay.DownloadCategories'
    ];

    /**
     * (non-PHPdoc)
     *
     * @see \Cake\Console\Shell::getOptionParser()
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser->addSubcommand('downloadCategories', [
            'help' => 'Execute DownloadCategories function. This will save eBay categories into database.',
            'parser' => $this->DownloadCategories->getOptionParser(),
        ]);
        return $parser;
    }
}
