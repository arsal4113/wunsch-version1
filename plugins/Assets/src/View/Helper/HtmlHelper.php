<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 06.04.18
 * Time: 11:16
 */

namespace Assets\View\Helper;


use Cake\Filesystem\File;
use Cake\View\View;

class HtmlHelper extends \Cake\View\Helper\HtmlHelper
{

    protected $buildTime;

    const BUILD_FILE = WWW_ROOT.'build';

    /**
     * Constructor
     *
     * ### Settings
     *
     * - `templates` Either a filename to a config containing templates.
     *   Or an array of templates to load. See Cake\View\StringTemplate for
     *   template formatting.
     *
     * ### Customizing tag sets
     *
     * Using the `templates` option you can redefine the tag HtmlHelper will use.
     *
     * @param \Cake\View\View $View The View this helper is being attached to.
     * @param array $config Configuration settings for the helper.
     */
    public function __construct(View $View, array $config = [])
    {
        parent::__construct($View, $config);
        $file = new File(self::BUILD_FILE);
        if ($file->exists()) {
            $this->buildTime = $file->read();
        }
        $file->close();
    }

    /**
     * Creates a link element for CSS stylesheets.
     *
     * ### Usage
     *
     * Include one CSS file:
     *
     * ```
     * echo $this->Html->css('styles.css');
     * ```
     *
     * Include multiple CSS files:
     *
     * ```
     * echo $this->Html->css(['one.css', 'two.css']);
     * ```
     *
     * Add the stylesheet to view block "css":
     *
     * ```
     * $this->Html->css('styles.css', ['block' => true]);
     * ```
     *
     * Add the stylesheet to a custom block:
     *
     * ```
     * $this->Html->css('styles.css', ['block' => 'layoutCss']);
     * ```
     *
     * ### Options
     *
     * - `block` Set to true to append output to view block "css" or provide
     *   custom block name.
     * - `once` Whether or not the css file should be checked for uniqueness. If true css
     *   files  will only be included once, use false to allow the same
     *   css to be included more than once per request.
     * - `plugin` False value will prevent parsing path as a plugin
     * - `rel` Defaults to 'stylesheet'. If equal to 'import' the stylesheet will be imported.
     * - `fullBase` If true the URL will get a full address for the css file.
     *
     * @param string|array $path The name of a CSS style sheet or an array containing names of
     *   CSS stylesheets. If `$path` is prefixed with '/', the path will be relative to the webroot
     *   of your application. Otherwise, the path will be relative to your CSS path, usually webroot/css.
     * @param array $options Array of options and HTML arguments.
     * @return string|null CSS `<link />` or `<style />` tag, depending on the type of link.
     * @link https://book.cakephp.org/3.0/en/views/helpers/html.html#linking-to-css-files
     */
    public function css($path, array $options = [])
    {
        $options += ['once' => true, 'block' => null, 'rel' => 'stylesheet'];

        if (is_array($path)) {
            $out = '';
            foreach ($path as $i) {
                $out .= "\n\t" . $this->css($i, $options);
            }
            if (empty($options['block'])) {
                return $out . "\n";
            }

            return null;
        }

        if (strpos($path, '//') !== false) {
            $url = $path;
        } else {
            $url = $this->addBuildTime($this->Url->css($path, $options));
            $options = array_diff_key($options, ['fullBase' => null, 'pathPrefix' => null]);
        }

        if ($options['once'] && isset($this->_includedAssets[__METHOD__][$path])) {
            return null;
        }
        unset($options['once']);
        $this->_includedAssets[__METHOD__][$path] = true;
        $templater = $this->templater();

        if ($options['rel'] === 'import') {
            $out = $templater->format('style', [
                'attrs' => $templater->formatAttributes($options, ['rel', 'block']),
                'content' => '@import url(' . $url . ');',
            ]);
        } else {
            $out = $templater->format('css', [
                'rel' => $options['rel'],
                'url' => $url,
                'attrs' => $templater->formatAttributes($options, ['rel', 'block']),
            ]);
        }

        if (empty($options['block'])) {
            return $out;
        }
        if ($options['block'] === true) {
            $options['block'] = __FUNCTION__;
        }
        $this->_View->append($options['block'], $out);
    }

    /**
     * Returns one or many `<script>` tags depending on the number of scripts given.
     *
     * If the filename is prefixed with "/", the path will be relative to the base path of your
     * application. Otherwise, the path will be relative to your JavaScript path, usually webroot/js.
     *
     * ### Usage
     *
     * Include one script file:
     *
     * ```
     * echo $this->Html->script('styles.js');
     * ```
     *
     * Include multiple script files:
     *
     * ```
     * echo $this->Html->script(['one.js', 'two.js']);
     * ```
     *
     * Add the script file to a custom block:
     *
     * ```
     * $this->Html->script('styles.js', ['block' => 'bodyScript']);
     * ```
     *
     * ### Options
     *
     * - `block` Set to true to append output to view block "script" or provide
     *   custom block name.
     * - `once` Whether or not the script should be checked for uniqueness. If true scripts will only be
     *   included once, use false to allow the same script to be included more than once per request.
     * - `plugin` False value will prevent parsing path as a plugin
     * - `fullBase` If true the url will get a full address for the script file.
     *
     * @param string|array $url String or array of javascript files to include
     * @param array $options Array of options, and html attributes see above.
     * @return string|null String of `<script />` tags or null if block is specified in options
     *   or if $once is true and the file has been included before.
     * @link https://book.cakephp.org/3.0/en/views/helpers/html.html#linking-to-javascript-files
     */
    public function script($url, array $options = [])
    {
        $defaults = ['block' => null, 'once' => true];
        $options += $defaults;

        if (is_array($url)) {
            $out = '';
            foreach ($url as $i) {
                $out .= "\n\t" . $this->script($i, $options);
            }
            if (empty($options['block'])) {
                return $out . "\n";
            }

            return null;
        }

        if (strpos($url, '//') === false) {
            $url = $this->addBuildTime($this->Url->script($url, $options));
            $options = array_diff_key($options, ['fullBase' => null, 'pathPrefix' => null]);
        }
        if ($options['once'] && isset($this->_includedAssets[__METHOD__][$url])) {
            return null;
        }
        $this->_includedAssets[__METHOD__][$url] = true;

        $out = $this->formatTemplate('javascriptlink', [
            'url' => $url,
            'attrs' => $this->templater()->formatAttributes($options, ['block', 'once']),
        ]);

        if (empty($options['block'])) {
            return $out;
        }
        if ($options['block'] === true) {
            $options['block'] = __FUNCTION__;
        }
        $this->_View->append($options['block'], $out);
    }

    /**
     * Add build time
     * @param $url
     * @return string
     */
    protected function addBuildTime($url)
    {
        if ($this->buildTime) {
            if (strpos($url, '?')) {
                $url .= '&';
            } else {
                $url .= '?';
            }
            $url .= 'build=' . $this->buildTime;
        }
        return $url;
    }
}