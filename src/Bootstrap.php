<?php

namespace KonstantinKS\ModuleTestFirst;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    //Метод, который вызывается автоматически при каждом запросе
    public function bootstrap($app): void
    {
        //Правила маршрутизации
        $app->getUrlManager()->addRules([
            'module-test-first' => 'module-test-first/test-one/index',
        ], false);

        /*
         * Регистрация модуля в приложении
         * (вместо указания в файле frontend/config/main.php
         */
        $app->setModule('module-test-first', 'KonstantinKS\ModuleTestFirst\Module');
    }
}
