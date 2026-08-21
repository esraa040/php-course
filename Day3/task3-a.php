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
    private $author;
    private $price;
    private $qty;

    function __construct($name, $author, $price, $qty = 0)
    {
        $this->name   = $name;
        $this->author = $author;
        $this->price  = $price;
        $this->qty    = $qty;
    }

    function getName()
    {
        return $this->name;
    }

    function getAuthor()
    {
        return $this->author;
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

    function __toString()
    {
        return "Book[name=" . $this->name . "," . $this->author . ",price=" . $this->price . ",qty=" . $this->qty . "]";
    }
}

echo "<h1> OOP Task 3 - a : Composition (Book has one Author) </h1>";

$author = new Author("Tan Ah Teck", "ahTeck@somewhere.com", "m");
echo $author, "<br>";
echo "name : ", $author->getName(), "<br>";
echo "email : ", $author->getEmail(), "<br>";
echo "gender : ", $author->getGender(), "<br>";

$author->setEmail("ahteck@nowhere.com");
echo "after setEmail : ", $author, "<br>";

echo "<h2> Book </h2>";
$book = new Book("php for kids", $author, 250.0);
echo $book, "<br>";

$book->setPrice(300.0);
$book->setQty(10);
echo $book, "<br>";

echo "author of the book : ", $book->getAuthor()->getName(), "<br>";
echo "price : ", $book->getPrice(), "<br>";
echo "qty : ", $book->getQty(), "<br>";
