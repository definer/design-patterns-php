<?php

namespace RefactoringGuru\FactoryMethod\My;

/*
 * Есть игроки, есть игры, и важно понимать какой игрок играет в какую игру
 * Для игроков есть абстрактный класс. Для Игр есть свой класс
 * */
abstract class Player {
    abstract public function classGame(): Game;

    public function playing(): string
    {
        $game = $this->classGame();

        return "I a`m playing {$game->getName()} game";
    }
}

interface Game
{
    public function getName();
}

class WowGame implements Game
{
    public function getName()
    {
        return 'World of Warcraft';
    }
}

class CsGame implements Game
{
    public function getName()
    {
        return 'Counter Strike';
    }
}

class Misha extends Player
{
    public function classGame(): Game
    {
        return new WowGame();
    }
}

class Sasha extends Player
{
    public function classGame(): Game
    {
        return new CsGame();
    }
}

function clientCode(Player $player) {
    echo $player->playing();
}

clientCode(new Misha());
