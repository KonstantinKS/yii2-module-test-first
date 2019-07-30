<?php

declare(strict_types=1);

namespace KonstantinKS\ModuleTestFirst\controllers;

use KonstantinKS\ModuleTestFirst\models\Logger;
use KonstantinKS\ModuleTestFirst\models\OnboardingNotification;
use KonstantinKS\ModuleTestFirst\components\UserRepository;
use yii\web\Controller;

/**
 * Тестовый класс для разбора паттерна наблюдатель
 *
 * @author Konstantin Karpov <k-karpov@inbox.ru>
 */
class TestObserverController extends Controller
{
    public $layout = 'observer';

    public function actionIndex()
    {
        $repository = new UserRepository;
        $repository->events->attach(new Logger(__DIR__ . "/../../files/log.txt"), "*");
        $repository->events->attach(new OnboardingNotification("1@example.com"), "users:created");
        $repository->initialize(__DIR__ . "/../../files/users.csv");
        $user = $repository->createUser([
            "name" => "John Smith",
            "email" => "john99@example.com",
        ]);
        //$repository->deleteUser($user);
        print_r($repository);
    }
}