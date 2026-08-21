<?php

class A
{
    public static $count = 0;
    public $name;

    static function test()
    {
        return self::$count++;
    }
}

class B extends A
{
    static function test()
    {
        return self::$count++;
    }
}

echo "<h1> OOP Task 5 - a : static variable with inheritance </h1>";

echo "A::\$count at the start = ", A::$count, "<br>";
echo "B::\$count at the start = ", B::$count, "<br>";

echo "<h2> calling A::test() </h2>";
echo "A::test() returns ", A::test(), " and now A::\$count = ", A::$count, "<br>";
echo "A::test() returns ", A::test(), " and now A::\$count = ", A::$count, "<br>";

echo "<h2> calling B::test() </h2>";
echo "B::test() returns ", B::test(), " and now A::\$count = ", A::$count, "<br>";
echo "B::test() returns ", B::test(), " and now A::\$count = ", A::$count, "<br>";

echo "<h2> the result </h2>";
echo "A::\$count = ", A::$count, "<br>";
echo "B::\$count = ", B::$count, "<br>";
echo "B did not declare a new \$count , so B shares the same static variable of A <br>";
echo "test() returns the value BEFORE the increment because \$count++ is post increment <br>";

class Engine
{
    private $type;

    function __construct($type)
    {
        $this->type = $type;
    }

    function getType()
    {
        return $this->type;
    }
}

class Car
{
    private $name;
    private $engine;

    function __construct($name, $type)
    {
        $this->name   = $name;
        $this->engine = new Engine($type);
    }

    function getName()
    {
        return $this->name;
    }

    function getEngine()
    {
        return $this->engine;
    }
}

class Employee
{
    private $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    function getName()
    {
        return $this->name;
    }
}

class Department
{
    private $name;
    private $employees;

    function __construct($name, $employees)
    {
        $this->name      = $name;
        $this->employees = $employees;
    }

    function getName()
    {
        return $this->name;
    }

    function getEmployees()
    {
        return $this->employees;
    }
}

echo "<h1> OOP Task 5 - b : Composition and Aggregation </h1>";

echo "<table border='1' cellpadding='8'>";
echo "<tr>";
echo "<th>  </th>";
echo "<th> Composition </th>";
echo "<th> Aggregation </th>";
echo "</tr>";

echo "<tr>";
echo "<td> relation </td>";
echo "<td> Has-A (strong) </td>";
echo "<td> Has-A (weak) </td>";
echo "</tr>";

echo "<tr>";
echo "<td> who creates the part </td>";
echo "<td> the whole creates the part inside itself </td>";
echo "<td> the part is created outside and passed to the whole </td>";
echo "</tr>";

echo "<tr>";
echo "<td> life time </td>";
echo "<td> the part dies with the whole </td>";
echo "<td> the part still lives after the whole dies </td>";
echo "</tr>";

echo "<tr>";
echo "<td> example </td>";
echo "<td> Car and Engine </td>";
echo "<td> Department and Employee </td>";
echo "</tr>";

echo "</table>";

echo "<h2> Composition : Car has an Engine </h2>";
$car = new Car("bmw", "diesel");
echo "car : ", $car->getName(), "<br>";
echo "engine : ", $car->getEngine()->getType(), "<br>";
echo "the Engine object was created inside the Car constructor , it can not live without the Car <br>";

echo "<h2> Aggregation : Department has Employees </h2>";
$e1 = new Employee("basmala");
$e2 = new Employee("mohammed");

$department = new Department("php department", [$e1, $e2]);

echo "department : ", $department->getName(), "<br>";

foreach ($department->getEmployees() as $employee) {
    echo "employee : ", $employee->getName(), "<br>";
}

echo "the Employee objects were created outside , they still live after the Department is removed <br>";

unset($department);

echo "after removing the department , employee ", $e1->getName(), " is still here <br>";
