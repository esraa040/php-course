<?php

interface Shape
{
    function getColor();

    function setColor($color);

    function isFilled();

    function setFilled($filled);

    function getArea();

    function getPerimeter();

    function __toString();
}

class Circle implements Shape
{
    protected $color  = "red";
    protected $filled = true;
    protected $radius = 1.0;

    function __construct($radius = 1.0, $color = "red", $filled = true)
    {
        $this->radius = $radius;
        $this->color  = $color;
        $this->filled = $filled;
    }

    function getColor()
    {
        return $this->color;
    }

    function setColor($color)
    {
        $this->color = $color;
    }

    function isFilled()
    {
        return $this->filled;
    }

    function setFilled($filled)
    {
        $this->filled = $filled;
    }

    function getRadius()
    {
        return $this->radius;
    }

    function setRadius($radius)
    {
        $this->radius = $radius;
    }

    function getArea()
    {
        return $this->radius * $this->radius * M_PI;
    }

    function getPerimeter()
    {
        return 2 * $this->radius * M_PI;
    }

    function __toString()
    {
        return "Circle[Shape[color=" . $this->color . ",filled=" . ($this->filled ? "true" : "false") . "],radius=" . $this->radius . "]";
    }
}

class Rectangle implements Shape
{
    protected $color  = "red";
    protected $filled = true;
    protected $width  = 1.0;
    protected $length = 1.0;

    function __construct($width = 1.0, $length = 1.0, $color = "red", $filled = true)
    {
        $this->width  = $width;
        $this->length = $length;
        $this->color  = $color;
        $this->filled = $filled;
    }

    function getColor()
    {
        return $this->color;
    }

    function setColor($color)
    {
        $this->color = $color;
    }

    function isFilled()
    {
        return $this->filled;
    }

    function setFilled($filled)
    {
        $this->filled = $filled;
    }

    function getWidth()
    {
        return $this->width;
    }

    function setWidth($width)
    {
        $this->width = $width;
    }

    function getLength()
    {
        return $this->length;
    }

    function setLength($length)
    {
        $this->length = $length;
    }

    function getArea()
    {
        return $this->width * $this->length;
    }

    function getPerimeter()
    {
        return 2 * ($this->width + $this->length);
    }

    function __toString()
    {
        return "Rectangle[Shape[color=" . $this->color . ",filled=" . ($this->filled ? "true" : "false") . "],width=" . $this->width . ",length=" . $this->length . "]";
    }
}

class Square extends Rectangle
{
    function __construct($side = 1.0, $color = "red", $filled = true)
    {
        parent::__construct($side, $side, $color, $filled);
    }

    function getSide()
    {
        return $this->width;
    }

    function setSide($side)
    {
        $this->width  = $side;
        $this->length = $side;
    }

    function setWidth($side)
    {
        $this->setSide($side);
    }

    function setLength($side)
    {
        $this->setSide($side);
    }

    function __toString()
    {
        return "Square[" . parent::__toString() . "]";
    }
}

echo "<h1> OOP Task 4 - b : Interface (Shape , Circle , Rectangle , Square) </h1>";

echo "<h2> Circle </h2>";
$c = new Circle(3.0, "blue", false);
echo $c, "<br>";
echo "area : ", $c->getArea(), "<br>";
echo "perimeter : ", $c->getPerimeter(), "<br>";

echo "<h2> Rectangle </h2>";
$r = new Rectangle(4.0, 6.0, "green", true);
echo $r, "<br>";
echo "area : ", $r->getArea(), "<br>";
echo "perimeter : ", $r->getPerimeter(), "<br>";

echo "<h2> Square </h2>";
$sq = new Square(5.0, "yellow", true);
echo $sq, "<br>";
echo "side : ", $sq->getSide(), "<br>";
echo "area : ", $sq->getArea(), "<br>";
echo "perimeter : ", $sq->getPerimeter(), "<br>";

$sq->setWidth(8.0);
echo "after setWidth(8) the length changed too : ", $sq, "<br>";

$sq->setLength(2.0);
echo "after setLength(2) the width changed too : ", $sq, "<br>";

echo "<h2> Polymorphism : every shape implements Shape </h2>";
$shapes = [$c, $r, $sq];

foreach ($shapes as $shape) {
    echo $shape, " ==> area : ", $shape->getArea(), " , perimeter : ", $shape->getPerimeter(), "<br>";
}
