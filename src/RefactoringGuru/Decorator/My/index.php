<?php

namespace RefactoringGuru\Decorator\Conceptual;

/*
 * У нас есть Сникерс, который обворачивается в этикетку, которая обворачивается в упаковку
 **/

interface Product
{
    public function box(): string;
}

class Sneakers implements Product
{
    public function box(): string
    {
        return 'Шоколадка сникерс';
    }
}

class Banana implements Product
{
    public function box(): string
    {
        return 'Банан';
    }
}

class Decorator implements Product
{
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function box(): string
    {
        return 'Обворачиваем (' . $this->product->box() . ')';
    }
}

class LabelDecorator extends Decorator
{
    public function box(): string
    {
        return 'Обворачиваем в этикетку(' . $this->product->box() . ')';
    }
}

class BoxDecorator extends Decorator
{
    public function box(): string
    {
        return 'Обворачиваем в упаковку(' . $this->product->box() . ')';
    }
}

function clientCode(Product $product): void
{
    echo "RESULT: " . $product->box();
}

$sneakers = new Sneakers;
$label = new LabelDecorator($sneakers);
$box = new BoxDecorator($label);

clientCode($box);
