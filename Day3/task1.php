<?php

class Circle
{
    private $radius;
    private $color;

    function __construct($radius = 1.0, $color = "red")
    {
        $this->radius = $radius;
        $this->color  = $color;
    }

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

class Employee
{
    private $id;
    private $firstName;
    private $lastName;
    private $salary;

    function __construct($id, $firstName, $lastName, $salary)
    {
        $this->id        = $id;
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
        $this->salary    = $salary;
    }

    function getId()
    {
        return $this->id;
    }

    function getFirstName()
    {
        return $this->firstName;
    }

    function getLastName()
    {
        return $this->lastName;
    }

    function getName()
    {
        return $this->firstName . " " . $this->lastName;
    }

    function getSalary()
    {
        return $this->salary;
    }

    function setSalary($salary)
    {
        $this->salary = $salary;
    }

    function getAnnualSalary()
    {
        return $this->salary * 12;
    }

    function raiseSalary($percent)
    {
        $this->salary = $this->salary + ($this->salary * $percent / 100);
        return $this->salary;
    }

    function __toString()
    {
        return "Employee[id=" . $this->id . ",name=" . $this->getName() . ",salary=" . $this->salary . "]";
    }
}

class Rectangle
{
    private $length;
    private $width;

    function __construct($length = 1.0, $width = 1.0)
    {
        $this->length = $length;
        $this->width  = $width;
    }

    function getLength()
    {
        return $this->length;
    }

    function setLength($length)
    {
        $this->length = $length;
    }

    function getWidth()
    {
        return $this->width;
    }

    function setWidth($width)
    {
        $this->width = $width;
    }

    function getArea()
    {
        return $this->length * $this->width;
    }

    function getPerimeter()
    {
        return 2 * ($this->length + $this->width);
    }

    function __toString()
    {
        return "Rectangle[length=" . $this->length . ",width=" . $this->width . "]";
    }
}

class InvoiceItem
{
    private $id;
    private $desc;
    private $qty;
    private $unitPrice;

    function __construct($id, $desc, $qty, $unitPrice)
    {
        $this->id        = $id;
        $this->desc      = $desc;
        $this->qty       = $qty;
        $this->unitPrice = $unitPrice;
    }

    function getId()
    {
        return $this->id;
    }

    function getDesc()
    {
        return $this->desc;
    }

    function getQty()
    {
        return $this->qty;
    }

    function setQty($qty)
    {
        $this->qty = $qty;
    }

    function getUnitPrice()
    {
        return $this->unitPrice;
    }

    function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }

    function getTotal()
    {
        return $this->unitPrice * $this->qty;
    }

    function __toString()
    {
        return "InvoiceItem[id=" . $this->id . ",desc=" . $this->desc . ",qty=" . $this->qty . ",unitPrice=" . $this->unitPrice . "]";
    }
}

echo "<h1> OOP Task 1 </h1>";

echo "<h2> Circle </h2>";
$c1 = new Circle();
echo $c1, "<br>";
echo "radius : ", $c1->getRadius(), "<br>";
echo "area : ", $c1->getArea(), "<br>";

$c2 = new Circle(5.0);
echo $c2, "<br>";
echo "area : ", $c2->getArea(), "<br>";

$c3 = new Circle(2.5, "blue");
$c3->setColor("green");
$c3->setRadius(3.0);
echo $c3, "<br>";
echo "area : ", $c3->getArea(), "<br>";

echo "<h2> Employee </h2>";
$e1 = new Employee(1, "basmala", "ahmed", 5000);
echo $e1, "<br>";
echo "name : ", $e1->getName(), "<br>";
echo "annual salary : ", $e1->getAnnualSalary(), "<br>";
echo "salary after raise 10% : ", $e1->raiseSalary(10), "<br>";
echo $e1, "<br>";

echo "<h2> Rectangle </h2>";
$r1 = new Rectangle();
echo $r1, "<br>";

$r2 = new Rectangle(4.0, 2.0);
echo $r2, "<br>";
echo "area : ", $r2->getArea(), "<br>";
echo "perimeter : ", $r2->getPerimeter(), "<br>";

echo "<h2> InvoiceItem </h2>";
$i1 = new InvoiceItem("A101", "pen", 5, 12.5);
echo $i1, "<br>";
echo "total : ", $i1->getTotal(), "<br>";
$i1->setQty(10);
$i1->setUnitPrice(10.0);
echo $i1, "<br>";
echo "total : ", $i1->getTotal(), "<br>";
