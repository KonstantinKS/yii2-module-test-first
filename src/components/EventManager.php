<?php

declare(strict_types=1);

namespace KonstantinKS\ModuleTestFirst\components;

use KonstantinKS\ModuleTestFirst\models\User;
use SplObserver;
use SplSubject as SplSubjectAlias;

/**
 * Пользовательский репозиторий представляет собой Издателя. Различные объекты
 * заинтересованы в отслеживании его внутреннего состояния, будь то добавление
 * нового пользователя или его удаление.
 *
 * @author Konstatin Karpov <k-karpov@inbox.ru>
 */
class EventManager implements SplSubjectAlias
{
    // Здесь находится реальная инфраструктура управления Наблюдателя. Обратите
    // внимание, что это не всё, за что отвечает наш класс. Его основная бизнес-
    // логика приведена ниже этих методов.

    /**
     * @var SplObserver[]
     */
    private $observers = [];

    public function __construct()
    {
        // Специальная группа событий для наблюдателей, которые хотят слушать
        // все события.
        $this->observers['*'] = [];
    }

    /**
     * Attach an SplObserver
     *
     * @link https://php.net/manual/en/splsubject.attach.php
     * @param SplObserver $observer <p>
     * The <b>SplObserver</b> to attach.
     * </p>
     * @param string $event
     * @return void
     * @since 5.1.0
     */
    public function attach(SplObserver $observer, string $event = "*"): void
    {
        $this->initEventGroup($event);
        $this->observers[$event][] = $observer;
    }

    /**
     * Detach an observer
     *
     * @link https://php.net/manual/en/splsubject.detach.php
     * @param SplObserver $observer <p>
     * The <b>SplObserver</b> to detach.
     * </p>
     * @param string $event
     * @return void
     * @since 5.1.0
     */
    public function detach(SplObserver $observer, string $event = "*"): void
    {
        foreach ($this->getEventObservers($event) as $key => $s) {
            if ($s === $observer) {
                unset($this->observers[$event][$key]);
            }
        }
    }

    /**
     * Notify an observer
     *
     * @link https://php.net/manual/en/splsubject.notify.php
     * @param string $event
     * @param null $data
     * @return void
     * @since 5.1.0
     */
    public function notify(string $event = "*", $data = null): void
    {
        echo "UserRepository: Broadcasting the '$event' event.\n";
        foreach ($this->getEventObservers($event) as $observer) {
            $observer->update($this, $event, $data);
        }
    }

    private function initEventGroup(string $event = "*"): void
    {
        if (!isset($this->observers[$event])) {
            $this->observers[$event] = [];
        }
    }

    private function getEventObservers(string $event = "*"): array
    {
        $this->initEventGroup($event);
        $group = $this->observers[$event];
        $all = $this->observers["*"];

        return array_merge($group, $all);
    }
}