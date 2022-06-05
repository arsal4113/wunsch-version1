<?php

namespace CatchTheme\View\Helper;

use Cake\Core\Plugin;
use Cake\Filesystem\File;
use Cake\View\Helper\HtmlHelper;

/**
 * React helper
 */
class ReactHelper extends HtmlHelper
{
    const MANIFEST_PATH = 'webroot/js/build/manifest.json';
    const MANIFEST_CACHE_KEY = 'react_helper_manifest_cache_key';
    /** @var array $manifest */
    protected $manifest;

    /**
     * @param string|string[] $file
     * @param array $options
     * @return string|null
     */
    public function script($file, array $options = [])
    {
        $this->readManifest();
        if ($this->manifest[$file] ?? false) {
            $file = $this->manifest[$file];
        }
        return parent::script($file, $options);
    }

    protected function readManifest()
    {
        if (!$this->manifest) {
            $this->manifest = $this->readManifestFromFile();
            return;
        }
    }

    /**
     * @return mixed
     */
    protected function readManifestFromFile()
    {
        $path = Plugin::path('CatchTheme') . self::MANIFEST_PATH;
        $file = new File($path);
        return json_decode($file->read(), true);
    }
}
