<?php

namespace app\assets;

use yii\helpers\Json;
use yii\web\AssetBundle;

class HighlightAsset extends AssetBundle
{
    const DEFAULT_SELECTOR = 'pre code';

    public $sourcePath = '@bower/highlightjs';
    public $css = [
        'styles/default.css',
    ];
    public $js = [
        YII_DEBUG ? 'highlight.pack.js' : 'highlight.pack.min.js',
    ];

    /**
     * @var string Preferred selector on which code Highlight would be applied.
     */
    public $selector = self::DEFAULT_SELECTOR;

    /**
     * @var array of options to be declared as js object with global [configuration](http://highlightjs.readthedocs.org/en/latest/api.html#configure-options)
     */
    public $options = [];


    public static function register($view)
    {
        $configOptions = [];
        $configSelector = self::DEFAULT_SELECTOR;
        try {
            /** @var self $thisBundle */
            $thisBundle = \Yii::$app->getAssetManager()->getBundle(__CLASS__);
            $configOptions = $thisBundle->options;
            $configSelector = $thisBundle->selector;
        } catch (\Exception $e) {
            // do nothing...
        }

        if (!empty($configOptions)) {
            $options = Json::encode($configOptions);
            $view->registerJs('hljs.configure("' . $options . '");');
        }

        if ($configSelector !== self::DEFAULT_SELECTOR) {
            $view->registerJs('
                $("' . $configSelector . '").each(function (i, block) {
                    hljs.highlightBlock(block);
                });'
            );
        } else {
            $view->registerJs('hljs.initHighlightingOnLoad();');
        }

        return parent::register($view);
    }
}
