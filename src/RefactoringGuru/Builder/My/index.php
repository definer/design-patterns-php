<?php

namespace RefactoringGuru\Builder\My;

// Нам необходимо построить машину
// Машины разные, есть машины о БМВ, есть Аудио и Мерседес, у всех разный салон, кузон и колеса

interface AutoInterface
{
    public function createSalon(): void;

    public function createKuzov(): void;

    public function createKolesa(): void;
}

abstract class Auto implements AutoInterface
{
    public $car;

    public function __construct()
    {
        $this->reset();
    }

    public function reset()
    {
        $this->car = new Car();
    }

    public function newCar(): Car
    {
        $result = $this->car;

        $this->reset();
        return $result;
    }
}

class BmwAuto extends Auto
{
    public function createSalon(): void
    {
        $this->car->parts[] = 'Новый салон для BMW';
    }

    public function createKuzov(): void
    {
        $this->car->parts[] = 'Новый кузов для BMW';
    }

    public function createKolesa(): void
    {
        $this->car->parts[] = 'Новые колеса для BMW';
    }
}

class Car
{
    public $parts = [];

    public function listParts(): void
    {
        echo "Product parts: " . implode(', ', $this->parts) . "\n\n";
    }
}

class Director
{
    public $auto;

    public function setAuto(Auto $auto): void
    {
        $this->auto = $auto;
    }

    public function buildMinimalViableProduct(): void
    {
        $this->auto->createSalon();
    }

    public function buildFullViableProduct(): void
    {
        $this->auto->createSalon();
        $this->auto->createKuzov();
        $this->auto->createKolesa();
    }
}

function clientcode()
{
    $bmwAuto = new BmwAuto();
    $bmwAuto->createKuzov();
    $bmwAuto->createKolesa();
    $bmwAuto->createSalon();
    echo $bmwAuto->newCar()->listParts();

    $obDirector = new Director();
    $obDirector->setAuto($bmwAuto);
    $obDirector->buildFullViableProduct();
    echo $bmwAuto->newCar()->listParts();
}

clientcode();
