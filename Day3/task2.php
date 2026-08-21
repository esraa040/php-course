<?php

class Account
{
    private $id;
    private $name;
    private $balance;

    function __construct($id, $name, $balance = 0)
    {
        $this->id      = $id;
        $this->name    = $name;
        $this->balance = $balance;
    }

    function getId()
    {
        return $this->id;
    }

    function getName()
    {
        return $this->name;
    }

    function getBalance()
    {
        return $this->balance;
    }

    function credit($amount)
    {
        $this->balance = $this->balance + $amount;
        return $this->balance;
    }

    function debit($amount)
    {
        if ($amount <= $this->balance) {
            $this->balance = $this->balance - $amount;
        } else {
            echo "Amount exceeded balance <br>";
        }
        return $this->balance;
    }

    function transferTo($another, $amount)
    {
        if ($amount <= $this->balance) {
            $this->balance = $this->balance - $amount;
            $another->credit($amount);
        } else {
            echo "Amount exceeded balance <br>";
        }
        return $this->balance;
    }

    function __toString()
    {
        return "Account[id=" . $this->id . ",name=" . $this->name . ",balance=" . $this->balance . "]";
    }
}

class Ball
{
    private $x;
    private $y;
    private $radius;
    private $xDelta;
    private $yDelta;

    function __construct($x, $y, $radius, $xDelta, $yDelta)
    {
        $this->x      = $x;
        $this->y      = $y;
        $this->radius = $radius;
        $this->xDelta = $xDelta;
        $this->yDelta = $yDelta;
    }

    function getX()
    {
        return $this->x;
    }

    function setX($x)
    {
        $this->x = $x;
    }

    function getY()
    {
        return $this->y;
    }

    function setY($y)
    {
        $this->y = $y;
    }

    function getRadius()
    {
        return $this->radius;
    }

    function setRadius($radius)
    {
        $this->radius = $radius;
    }

    function getXDelta()
    {
        return $this->xDelta;
    }

    function setXDelta($xDelta)
    {
        $this->xDelta = $xDelta;
    }

    function getYDelta()
    {
        return $this->yDelta;
    }

    function setYDelta($yDelta)
    {
        $this->yDelta = $yDelta;
    }

    function move()
    {
        $this->x = $this->x + $this->xDelta;
        $this->y = $this->y + $this->yDelta;
    }

    function reflectHorizontal()
    {
        $this->xDelta = -$this->xDelta;
    }

    function reflectVertical()
    {
        $this->yDelta = -$this->yDelta;
    }

    function __toString()
    {
        return "Ball[(" . $this->x . "," . $this->y . "),speed=(" . $this->xDelta . "," . $this->yDelta . ")]";
    }
}

echo "<h1> OOP Task 2 </h1>";

echo "<h2> Account </h2>";
$a1 = new Account("A101", "basmala", 1000);
$a2 = new Account("A102", "habiba");

echo $a1, "<br>";
echo $a2, "<br>";

echo "credit 500 : ", $a1->credit(500), "<br>";
echo "debit 200 : ", $a1->debit(200), "<br>";
echo "debit 5000 : ", $a1->debit(5000), "<br>";
echo "transfer 300 to habiba : ", $a1->transferTo($a2, 300), "<br>";

echo $a1, "<br>";
echo $a2, "<br>";

echo "<h2> Ball </h2>";
$b = new Ball(50, 60, 5, 10, -15);
echo $b, "<br>";

$b->move();
echo "after move : ", $b, "<br>";

$b->reflectHorizontal();
echo "after reflectHorizontal : ", $b, "<br>";

$b->move();
echo "after move : ", $b, "<br>";

$b->reflectVertical();
echo "after reflectVertical : ", $b, "<br>";

$b->move();
echo "after move : ", $b, "<br>";
