<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\View\StringTemplateTrait;

class PictureHelper extends Helper
{
    use StringTemplateTrait;

    const PLACEHOLDER = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';

    public $helpers = ['Html', 'Url'];

    protected $_defaultConfig = [
        'templates' => [
            'source' => '<source srcset="{{url}}"{{attrs}}/>',
        ]
    ];


    public function source($path, array $options = [])
    {
        $path = $this->Url->image($path, $options);
        $options = array_diff_key($options, ['fullBase' => null, 'pathPrefix' => null]);

        if (!isset($options['alt'])) {
            $options['alt'] = '';
        }

        $url = false;
        if (!empty($options['url'])) {
            $url = $options['url'];
            unset($options['url']);
        }

        $templater = $this->templater();
        $source = $templater->format('source', [
            'url' => $path,
            'attrs' => $templater->formatAttributes($options),
        ]);

        if ($url) {
            return $templater->format('link', [
                'url' => $this->Url->build($url),
                'attrs' => null,
                'content' => $source
            ]);
        }
        return $source;
    }

    public function picture($what, $xlarge, $large, $medium, $small, $xsmall, $lazyload)
    {
        $tags = ['alt' => $what->banner_image_alt_tag, 'title' => $what->banner_image_title_tag];


        if (!empty($what->$xlarge)) {
            $xl = $this->Html->image($lazyload ? self::PLACEHOLDER : $what->$xlarge, $tags + ['data-lazy' => $what->$xlarge]);
        } else {
            $xl = NULL;
        }

        if (!empty($what->$large)) {
            $lg = $this->source($lazyload ? self::PLACEHOLDER : $what->$large, array_merge($tags, ['media' => "(max-width: 1280px) and (min-width: 1025px)", 'data-lazy-srcset' => $what->$large]));
        } else {
            $lg = NULL;
        }

        if (!empty($what->$medium)) {
            $md = $this->source($lazyload ? self::PLACEHOLDER : $what->$medium, array_merge($tags, ['media' => "(max-width: 1024px) and (min-width: 768px)", 'data-lazy-srcset' => $what->$medium]));
        } else {
            $md = NULL;
        }

        if (!empty($what->$small)) {
            $sm = $this->source($lazyload ? self::PLACEHOLDER : $what->$small, array_merge($tags, ['media' => "(max-width: 767px) and (min-width: 481px)", 'data-lazy-srcset' => $what->$small]));
        } else {
            $sm = NULL;
        }

        if (!empty($what->$xsmall)) {
            $xs = $this->source($lazyload ? self::PLACEHOLDER : $what->$xsmall, array_merge($tags, ['media' => "(max-width: 480px)", 'data-lazy-srcset' => $what->$xsmall]));
        } else {
            $xs = NULL;
        }

        return "<picture>$lg $md $sm $xs $xl</picture>";
    }
}
