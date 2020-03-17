<?php

namespace RefactoringGuru\Composite\Conceptual;

/*
 * У нас есть компьютеры
 * У компьютеров есть комплектующие, раздельные и комплектные
 * Класс позволяет все это собрать
 *
 * На выходе мы получаем кейс - который состоит из своих частей
 * */
abstract class Part {

    protected $parent;

    protected $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function setParent(Part $parent)
    {
        $this->parent = $parent;
    }

    public function getParent(): Part
    {
        return $this->parent;
    }

    public function getTitle(): String
    {
        return $this->title;
    }

    public function add(Part $component): void { }

    public function remove(Part $component): void { }

    public function isComposite(): bool
    {
        return false;
    }

    abstract public function operation(): string;
}

class Power extends Part
{
    public function operation(): string
    {
        return "Блок питания";
    }
}

class Ram extends Part
{
    public function operation(): string
    {
        return "Оперативная память";
    }
}

class VideoCard extends Part
{
    public function operation(): string
    {
        return "Видео карта";
    }
}

class Composite extends Part
{
    /**
     * @var \SplObjectStorage
     */
    protected $parts;

    public function __construct(string $title)
    {
        parent::__construct($title);
        $this->parts = new \SplObjectStorage;
    }

    public function add(Part $part): void
    {
        $this->parts->attach($part);
        $part->setParent($this);
    }

    public function remove(Part $part): void
    {
        $this->parts->detach($part);
        $part->setParent(null);
    }

    public function isComposite(): bool
    {
        return true;
    }

    public function operation(): string
    {
        $results = [];
        foreach ($this->parts as $child) {
            $results[] = $child->operation();
        }

        return $this->title . ' состоит из: ('. implode("+", $results) . ')';
    }
}

function clientcode(Part $assembly)
{
    echo $assembly->operation();
}

$ram = new Ram('Оперативная плата');
$vc = new VideoCard('Видео карта');
$power = new Power('Блок питания');

$motherboard = new Composite('Материнская плата');
$motherboard->add($ram);
$motherboard->add($vc);
$motherboard->add($power);

$computer = new Composite('Новенький компьютер');
$computer->add($motherboard);

clientcode($computer);
