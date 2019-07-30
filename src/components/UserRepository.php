<?php

declare(strict_types=1);

namespace KonstantinKS\ModuleTestFirst\components;

use KonstantinKS\ModuleTestFirst\models\User;

/**
 * Пользовательский репозиторий представляет собой Издателя. Различные объекты
 * заинтересованы в отслеживании его внутреннего состояния, будь то добавление
 * нового пользователя или его удаление.
 *
 * @author Konstatin Karpov <k-karpov@inbox.ru>
 */
class UserRepository
{
    /**
     * @var array Список пользователей.
     */
    private $users = [];

    // Здесь находится реальная инфраструктура управления Наблюдателя. Обратите
    // внимание, что это не всё, за что отвечает наш класс. Его основная бизнес-
    // логика приведена ниже этих методов.

    /**
     * @var EventManager
     */
    public $events;

    public function __construct()
    {
        // Специальная группа событий для наблюдателей, которые хотят слушать
        // все события.
        $this->events = new EventManager();
    }

    // Вот методы, представляющие бизнес-логику класса.

    public function initialize($filename): void
    {
        echo "UserRepository: Loading user records from a file.\n";
        // ...
        $this->events->notify("users:init", $filename);
    }

    public function createUser(array $data): User
    {
        echo "UserRepository: Creating a user.\n";

        $user = new User;
        $user->update($data);

        $id = bin2hex(openssl_random_pseudo_bytes(16));
        $user->update(["id" => $id]);
        $this->users[$id] = $user;

        $this->events->notify("users:created", $user);

        return $user;
    }

    public function updateUser(User $user, array $data): User
    {
        echo "UserRepository: Updating a user.\n";

        $id = $user->attributes["id"];
        if (!isset($this->users[$id])) {
            return null;
        }

        $user = $this->users[$id];
        $user->update($data);

        $this->events->notify("users:updated", $user);

        return $user;
    }

    public function deleteUser(User $user): void
    {
        echo "UserRepository: Deleting a user.\n";

        $id = $user->attributes["id"];
        if (!isset($this->users[$id])) {
            return;
        }

        unset($this->users[$id]);

        $this->events->notify("users:deleted", $user);
    }
}