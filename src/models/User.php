<?php

declare(strict_types=1);

namespace KonstantinKS\ModuleTestFirst\models;

/**
 * Давайте сохраним класс Пользователя тривиальным, так как он не является
 * главной темой нашего примера.
 *
 * @author Konstantin Karpov <k-karpov@inbox.ru>
 */
class User
{
    public $attributes = [];

    public function update($data): void
    {
        $this->attributes = array_merge($this->attributes, $data);
    }
}