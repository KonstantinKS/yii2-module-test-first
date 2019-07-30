<?php

declare(strict_types=1);

namespace KonstantinKS\ModuleTestFirst\models;

use SplObserver as SplObserverAlias;
use SplSubject;

/**
 * Этот Конкретный Компонент регистрирует все события, на которые он подписан.
 *
 * @author Konstatin Karpov <k-karpov@inbox.ru>
 */
class Logger implements SplObserverAlias
{
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
        if (file_exists($this->filename)) {
            unlink($this->filename);
        }
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
        $entry = date("Y-m-d H:i:s") . ": '$event' with data '" . json_encode($data) . "'\n";
        file_put_contents($this->filename, $entry, FILE_APPEND);

        echo "Logger: I've written '$event' entry to the log.\n";
    }
}