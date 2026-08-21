<?php

class Author
{
    private $name;
    private $email;
    private $gender;

    function __construct($name, $email, $gender)
    {
        $this->name   = $name;
        $this->email  = $email;
        $this->gender = $gender;
    }

    function getName()
    {
        return $this->name;
    }

    function getEmail()
    {
        return $this->email;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function getGender()
    {
        return $this->gender;
    }

    function __toString()
    {
        return "Author[name=" . $this->name . ",email=" . $this->email . ",gender=" . $this->gender . "]";
    }
}

class Book
{
    private $name;
    private $authors;
    private $price;
    private $qty;

    function __construct($name, $authors, $price, $qty = 0)
    {
        $this->name    = $name;
        $this->authors = $authors;
        $this->price   = $price;
        $this->qty     = $qty;
    }

    function getName()
    {
        return $this->name;
    }

    function getAuthors()
    {
        return $this->authors;
    }

    function getPrice()
    {
        return $this->price;
    }

    function setPrice($price)
    {
        $this->price = $price;
    }

    function getQty()
    {
        return $this->qty;
    }

    function setQty($qty)
    {
        $this->qty = $qty;
    }

    function getAuthorNames()
    {
        $names = [];

        foreach ($this->authors as $author) {
            array_push($names, $author->getName());
        }

        return implode(",", $names);
    }

    function __toString()
    {
        $allAuthors = [];

        foreach ($this->authors as $author) {
            array_push($allAuthors, $author->__toString());
        }

        return "Book[name=" . $this->name . ",authors={" . implode(",", $allAuthors) . "},price=" . $this->price . ",qty=" . $this->qty . "]";
    }
}

echo "<h1> OOP Task 3 - b : Book has many Authors </h1>";

$a1 = new Author("basmala", "basmala@iti.com", "f");
$a2 = new Author("mohammed", "mohammed@iti.com", "m");
$a3 = new Author("habiba", "habiba@iti.com", "f");

$authors = [$a1, $a2, $a3];

$book = new Book("php with oop", $authors, 500.0, 20);
echo $book, "<br>";

echo "<h2> getAuthorNames() </h2>";
echo $book->getAuthorNames(), "<br>";

echo "<h2> loop on getAuthors() </h2>";
foreach ($book->getAuthors() as $author) {
    echo $author, "<br>";
}

$book->setPrice(450.0);
$book->setQty(5);
echo "<h2> after setPrice and setQty </h2>";
echo $book, "<br>";
