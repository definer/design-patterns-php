<?php

interface Family {
    public function createBoy(): AbstractBoy;
    public function createGirl(): AbstractGirl;
}

interface AbstractBoy
{
    public function usefulFunctionBoy(): string;
}

interface AbstractGirl
{
    public function usefulFunctionGirl(): string;

    public function usefulFriend(AbstractBoy $badFriend): string;
}

class NewMomA implements Family {
    public function createBoy(): AbstractBoy
    {
        return new NewBoyA;
    }

    public function createGirl(): AbstractGirl
    {
        return new NewGirlA;
    }
}

class BadMom implements Family {
    public function createBoy(): AbstractBoy
    {
        return new NewBoyA;
    }

    public function createGirl(): AbstractGirl
    {
        return new NewBadGirl;
    }
}

class NewBoyA implements AbstractBoy {

    public function usefulFunctionBoy(): string
    {
        return "Yes, i`m Boy!";
    }
}

class NewGirlA implements AbstractGirl {

    public function usefulFunctionGirl(): string
    {
        return "Yes, i`m Girl!";
    }

    public function usefulFriend(AbstractBoy $badFriend): string
    {
        return "Yes, Rodi is done!";
    }
}

class NewBadGirl implements AbstractGirl {

    public function usefulFunctionGirl(): string
    {
        return "Yes, i`m bad girl!";
    }

    public function usefulFriend(AbstractBoy $badFriend): string
    {
        $girl = $badFriend->usefulFunctionBoy();
        return "Yes, Rodi is done! дружу с ({$girl})";
    }
}

function clientCode(Family $factory)
{
    $boy = $factory->createBoy();
    $girl = $factory->createGirl();

    echo $boy->usefulFunctionBoy() . "\n";
    echo $girl->usefulFunctionGirl() . "\n";
}

function badClient(Family $factory)
{
    $badGirl = $factory->createGirl();
    $badFriend = $factory->createBoy();

    echo $badGirl->usefulFunctionGirl() . "\n";
    echo $badGirl->usefulFriend($badFriend) . "\n";
}

clientCode(new NewMomA);
badClient(new BadMom);
