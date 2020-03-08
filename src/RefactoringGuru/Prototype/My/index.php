<?php

namespace RefactoringGuru\Prototype\My;

class Product
{
    public $title;

    public $price;

    public $description;

    public $category;

    public $offers;

    public function __construct(string $title, string $description, int $price, Category $category)
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
    }

    public function addOffers(string $offer): void
    {
        $this->offers[] = $offer;
    }

    public function __clone()
    {
        $this->title = 'Copy of ' . $this->title;
        $this->category->addProduct($this);
        $this->offers = [];
    }
}

class Category
{
    public $title;

    public $product;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function addProduct(Product $product): void
    {
        $this->product = $product;
    }
}

function clientCode()
{
    $category = new Category('Коляски');
    $obProduct = new Product('Первый товар', 'Второе описание', 5600, $category);
    $obProduct->addOffers('Fantasy Beige');

    $draft = clone $obProduct;

    echo $draft->title;
    echo " ";
    echo $draft->category->title;
}

clientCode();
