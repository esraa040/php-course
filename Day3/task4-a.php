<?php

abstract class Person
{
    protected $name;
    protected $address;

    function __construct($name, $address)
    {
        $this->name    = $name;
        $this->address = $address;
    }

    function getName()
    {
        return $this->name;
    }

    function getAddress()
    {
        return $this->address;
    }

    function setAddress($address)
    {
        $this->address = $address;
    }

    abstract function __toString();
}

class Student extends Person
{
    private $program;
    private $year;
    private $fee;

    function __construct($name, $address, $program, $year, $fee)
    {
        parent::__construct($name, $address);
        $this->program = $program;
        $this->year    = $year;
        $this->fee     = $fee;
    }

    function getProgram()
    {
        return $this->program;
    }

    function setProgram($program)
    {
        $this->program = $program;
    }

    function getYear()
    {
        return $this->year;
    }

    function setYear($year)
    {
        $this->year = $year;
    }

    function getFee()
    {
        return $this->fee;
    }

    function setFee($fee)
    {
        $this->fee = $fee;
    }

    function __toString()
    {
        return "Student[Person[name=" . $this->name . ",address=" . $this->address . "],program=" . $this->program . ",year=" . $this->year . ",fee=" . $this->fee . "]";
    }
}

class Staff extends Person
{
    private $school;
    private $pay;

    function __construct($name, $address, $school, $pay)
    {
        parent::__construct($name, $address);
        $this->school = $school;
        $this->pay    = $pay;
    }

    function getSchool()
    {
        return $this->school;
    }

    function setSchool($school)
    {
        $this->school = $school;
    }

    function getPay()
    {
        return $this->pay;
    }

    function setPay($pay)
    {
        $this->pay = $pay;
    }

    function __toString()
    {
        return "Staff[Person[name=" . $this->name . ",address=" . $this->address . "],school=" . $this->school . ",pay=" . $this->pay . "]";
    }
}

echo "<h1> OOP Task 4 - a : Abstract Class (Person , Student , Staff) </h1>";

$s = new Student("basmala", "cairo", "php track", 3, 5000.0);
echo $s, "<br>";
echo "name : ", $s->getName(), "<br>";
echo "program : ", $s->getProgram(), "<br>";
echo "year : ", $s->getYear(), "<br>";
echo "fee : ", $s->getFee(), "<br>";

$s->setProgram("laravel track");
$s->setYear(4);
$s->setFee(7000.0);
$s->setAddress("menoufia");
echo "after setters : ", $s, "<br>";

echo "<h2> Staff </h2>";
$t = new Staff("mohammed", "sadat", "ITI", 12000.0);
echo $t, "<br>";
echo "school : ", $t->getSchool(), "<br>";
echo "pay : ", $t->getPay(), "<br>";

$t->setSchool("ITI Menoufia");
$t->setPay(15000.0);
echo "after setters : ", $t, "<br>";

echo "<h2> Polymorphism : one loop , different toString </h2>";
$people = [$s, $t];

foreach ($people as $person) {
    echo $person, "<br>";
}

echo "<h2> Person is abstract , you can not take object from it </h2>";
echo "new Person(...) ==> Error : Cannot instantiate abstract class Person <br>";
