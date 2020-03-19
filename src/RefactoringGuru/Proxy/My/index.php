<?php

namespace RefactoringGuru\Proxy\My;

/*
 * Кеширование продуктов
 *
 * Нам необходимо кешировать продукты и проверять перед выдачей есть ли кешь
 *
 * */
interface ProductInterface
{
    public function get($name): string;
}

class Product implements ProductInterface
{
    public $name = 'Iphone 11';

    public function get($name): string
    {
        return $this->name;
    }
}

class ProductCache implements ProductInterface
{
    public $product;

    private $cache = [];

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function get($name): string
    {
        if (!isset($this->cache[$name])) {
            $result = $this->product->get($name);
            $this->cache[$name] = $result;
        } else {
            echo "Берем с кеша.\n";
        }

       return $this->cache[$name];
    }
}

function clientcode(ProductInterface $subject)
{
    echo $subject->get('Iphone 11');
    echo "\n";

}

$product = new Product();
$productCache = new ProductCache($product);
clientcode($productCache);
clientcode($productCache);
