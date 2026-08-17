<?php
require "../navbar.php";

$data = [
    [
        "name" => "basmala",
        "address" => "cairo"
    ],
    [
        "name" => "habiba",
        "address" => "sadat"
    ],
    [
        "name" => "mohammed",
        "address" => "menoufia"
    ]
];


echo "<table border='1' class='table table-striped table-bordered table-hover w-50'>";

echo "<thead>";
echo "<tr>";
echo "<td>";
echo "id";
echo "</td>";
echo "<td>";
echo "name";
echo "</td>";
echo "<td>";
echo "address";
echo "</td>";
echo "</tr>";
echo "</thead>";

echo "<tbody>";
$j = 0;
foreach ($data as $user) {
    echo "<tr>";
    echo "<td>" . ++$j . "</td>";

    foreach ($user as $key => $value) {
        echo "<td>" . $value . "</td>";
    }

    echo "</tr>";
}
echo "</tbody>";

echo "</table>";
