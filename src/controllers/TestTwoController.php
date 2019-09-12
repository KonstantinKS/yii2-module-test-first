<?php

declare(strict_types=1);

namespace KonstantinKS\ModuleTestFirst\controllers;

use Demliz\RenderRsl\RslDocumentIdentifier;
use KonstantinKS\ModuleTestFirst\TestOneAssetsBundle;
use yii\web\Controller;

class TestTwoController extends Controller
{
    //public $layout = 'main';

    public function actionIndex(): void
    {
        // регистрируем ресурсы:
        TestOneAssetsBundle::register($this->view);

        $rslDocId = new RslDocumentIdentifier('rsl010', '123541256');

        var_dump($rslDocId);

        echo $rslDocId;

//        return $this->render('index', [
//            'data' => $datas ?? false,
//            'render' => $render ?? false,
//        ]);
    }
}
