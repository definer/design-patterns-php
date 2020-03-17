<?php

namespace RefactoringGuru\Facade\Conceptual;

/*
 * Есть класс по работе с телеграм, который отправляет сообщения, но перед этим авторизовывается в системе
 * Фасад выполняет все необходимое в один клик
 * */
class Facade
{
    public $telegram;

    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
    }

    public function run(string $message): void
    {
        echo $this->telegram->auth();
        echo "\n";
        echo $this->telegram->sendMessgae($message);
        echo "\n";
    }
}

class Telegram
{
    public function auth(): string
    {
        return "Ура! Мы авторизовались";
    }

    public function sendMessgae(string $message): string
    {
        return $message;
    }
}

function clientcode(string $message)
{
    $telegram = new Telegram();
    $facade = new Facade($telegram);

    $facade->run($message);
}

clientcode('Новое сообщение');
