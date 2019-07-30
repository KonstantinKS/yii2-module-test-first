<?php

declare(strict_types=1);

namespace KonstantinKS\ModuleTestFirst\models;

use SplObserver as SplObserverAlias;
use SplSubject;
use Yii;

/**
 * Этот Конкретный Компонент отправляет начальные инструкции новым
 * пользователям. Клиент несёт ответственность за присоединение этого компонента
 * к соответствующему событию создания пользователя.
 * 
 * @author Konstatin Karpov <k-karpov@inbox.ru>
 */
class OnboardingNotification implements SplObserverAlias
{
    private $adminEmail;

    public function __construct($adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    /**
     * Receive update from subject
     *
     * @link https://php.net/manual/en/splobserver.update.php
     * @param SplSubject $repository
     * @param string|null $event
     * @param null $data
     * @return void
     * @since 5.1.0
     */
    public function update(SplSubject $repository, string $event = null, $data = null): void
    {
        mail($this->adminEmail,
            "Onboarding required",
            "We have a new user. Here's his info: " .json_encode($data)
        );

        Yii::$app->mailer->compose()
            ->setFrom($this->adminEmail)
            ->setTo(Yii::$app->params['senderEmail'])
            ->setSubject('Observing required')
            ->setTextBody('We have a new user. Here\'s his info: ' .json_encode($data))
            ->setHtmlBody('<b>текст сообщения в формате HTML</b>')
            ->send();

        echo "OnboardingNotification: The notification has been emailed!\n";
    }
}