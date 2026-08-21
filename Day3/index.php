<?php

$tasks = [
    "task1.php"    => "Task 1 : Circle , Employee , Rectangle , InvoiceItem",
    "task2.php"    => "Task 2 : Account , Ball",
    "task3-a.php"  => "Task 3 - a : Composition , Book has one Author",
    "task3-b.php"  => "Task 3 - b : Book has many Authors",
    "task3-c.php"  => "Task 3 - c : Book with isbn",
    "task3-d.php"  => "Task 3 - d : Circle as Trait + Cylinder",
    "task4-a.php"  => "Task 4 - a : Abstract Class , Person , Student , Staff",
    "task4-b.php"  => "Task 4 - b : Interface , Shape , Circle , Rectangle , Square",
    "task5.php"    => "Task 5 : static with inheritance + Composition and Aggregation",
];

echo "<h1> Day3 : OOP Tasks </h1>";

echo "<ul>";

foreach ($tasks as $file => $title) {
    echo "<li>";
    echo "<a href='" . $file . "'>" . $title . "</a>";
    echo "</li>";
}

echo "</ul>";
