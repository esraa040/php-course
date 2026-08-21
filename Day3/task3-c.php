<?php

class Author
{
    private $name;
    private $email;

    function __construct($name, $email)
    {
        $this->name  = $name;
        $this->email = $email;
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

    function __toString()
    {
        return "Author[name=" . $this->name . ",email=" . $this->email . "]";
    }
}

class Book
{
    private $isbn;
    private $name;
    private $author;
    private $price;
    private $qty;

    function __construct($isbn, $name, $author, $price, $qty = 0)
    {
        $this->isbn   = $isbn;
        $this->name   = $name;
        $this->author = $author;
        $this->price  = $price;
        $this->qty    = $qty;
    }

    function getIsbn()
    {
        return $this->isbn;
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

    function getAuthorName()
    {
        return $this->author->getName();
    }

    function __toString()
    {
        return "Book[isbn=" . $this->isbn . ",name=" . $this->name . "," . $this->author . ",price=" . $this->price . ",qty=" . $this->qty . "]";
    }
}

echo "<h1> OOP Task 3 - c : Book with isbn </h1>";

$author = new Author("basmala", "basmala@iti.com");
echo $author, "<br>";

$book = new Book("978-1-4028", "learn php", $author, 350.0);
echo $book, "<br>";

echo "<h2> methods </h2>";
echo "isbn : ", $book->getIsbn(), "<br>";
echo "name : ", $book->getName(), "<br>";
echo "author name : ", $book->getAuthorName(), "<br>";
echo "author email : ", $book->getAuthor()->getEmail(), "<br>";
echo "price : ", $book->getPrice(), "<br>";
echo "qty : ", $book->getQty(), "<br>";

$book->setPrice(400.0);
$book->setQty(15);
echo "<h2> after setPrice and setQty </h2>";
echo $book, "<br>";
