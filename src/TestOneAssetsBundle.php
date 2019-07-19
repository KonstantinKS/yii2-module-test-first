<?php

declare(strict_types=1);

namespace KonstantinKS\ModuleTestFirst;

use yii\web\AssetBundle;

class TestOneAssetsBundle extends AssetBundle
{
    public $sourcePath = '@vendor/konstantinks/yii2-module-test-first/assets';

    public $css = [
        'css/style.css',
    ];
}
