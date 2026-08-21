<?php

trait CircleTrait
{
    private $radius = 1.0;
    private $color  = "red";

    function getRadius()
    {
        return $this->radius;
    }

    function setRadius($radius)
    {
        $this->radius = $radius;
    }

    function getColor()
    {
        return $this->color;
    }

    function setColor($color)
    {
        $this->color = $color;
    }

    function getArea()
    {
        return $this->radius * $this->radius * M_PI;
    }

    function __toString()
    {
        return "Circle[radius=" . $this->radius . ",color=" . $this->color . "]";
    }
}

class Circle
{
    use CircleTrait;

    function __construct($radius = 1.0, $color = "red")
    {
        $this->radius = $radius;
        $this->color  = $color;
    }
}

class Cylinder extends Circle
{
    private $height;

    function __construct($radius = 1.0, $height = 1.0, $color = "red")
    {
        parent::__construct($radius, $color);
        $this->height = $height;
    }

    function getHeight()
    {
        return $this->height;
    }

    function setHeight($height)
    {
        $this->height = $height;
    }

    function getVolume()
    {
        return $this->getArea() * $this->height;
    }

    function __toString()
    {
        return "Cylinder[" . parent::__toString() . ",height=" . $this->height . "]";
    }
}

echo "<h1> OOP Task 3 - d : Circle as Trait + Cylinder </h1>";

echo "<h2> Circle (uses the trait) </h2>";
$c1 = new Circle();
echo $c1, "<br>";
echo "area : ", $c1->getArea(), "<br>";

$c2 = new Circle(5.0, "blue");
echo $c2, "<br>";
echo "area : ", $c2->getArea(), "<br>";

echo "<h2> Cylinder extends Circle </h2>";
$cy1 = new Cylinder();
echo $cy1, "<br>";
echo "area : ", $cy1->getArea(), "<br>";
echo "volume : ", $cy1->getVolume(), "<br>";

$cy2 = new Cylinder(2.0, 10.0, "green");
echo $cy2, "<br>";
echo "radius : ", $cy2->getRadius(), "<br>";
echo "height : ", $cy2->getHeight(), "<br>";
echo "area : ", $cy2->getArea(), "<br>";
echo "volume : ", $cy2->getVolume(), "<br>";

$cy2->setRadius(3.0);
$cy2->setHeight(4.0);
$cy2->setColor("yellow");
echo "after setters : ", $cy2, "<br>";
echo "volume : ", $cy2->getVolume(), "<br>";
