<?php

namespace RefactoringGuru\Bridge\Conceptual;

/**
 * Задача
 * Есть пульты управления от телевизоры и магнитофона
 * Необходимо настроить между ними мосты
 * Пульты умеют отправлять команды,телевизор и магнитофон выполняют команды
 */

// У нас есть абстрактный класс пультов

abstract class Remote
{
    public $manager;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    abstract public function onRemote();

    abstract public function offRemote();
}

class RemotePult extends Remote
{
    public function onRemote()
    {
        return 'Какая то операция высшего класса' . ' ' . $this->manager->on();
    }

    public function offRemote()
    {
        return 'Какая то операция высшего класса' . ' ' .  $this->manager->off();
    }
}

interface Manager
{
    // Включить
    public function on();

    // Выключить
    public function off();
}

class Tv implements Manager {

    // Включить
    public function on()
    {
        return 'Включить телевизор';
    }

    // Выключить
    public function off()
    {
        return 'Выключить телевизор';
    }
}

class RecordPlayer implements Manager {

    // Включить
    public function on()
    {
        return 'Включить магнитофон';
    }

    // Выключить
    public function off()
    {
        return 'Выключить магнитофон';
    }
}

function clientCode(Remote $remote)
{
    echo $remote->onRemote();

    echo "\n";

    echo $remote->offRemote();

    echo "\n";
}

$manager = new Tv;
$remote = new RemotePult($manager);
clientCode($remote);

echo "\n";
echo "\n";

$manager = new RecordPlayer;
$remote = new RemotePult($manager);
clientCode($remote);
