<?php

declare(strict_types=1);

namespace KonstantinKS\ModuleTestFirst\controllers;

use KonstantinKS\ModuleTestFirst\TestOneAssetsBundle;
use yii\web\Controller;
use KonstantinKS\ModuleTestFirst\models\ModuleTestFirstOne;

class TestOneController extends Controller
{
    //public $layout = 'main';

    public function actionIndex()
    {
        // регистрируем ресурсы:
        TestOneAssetsBundle::register($this->view);

        $datas = ModuleTestFirstOne::find()->all();

        return $this->render('index', [
            'data' => $datas,
            'render' => $render ?? false,
        ]);
    }
}
