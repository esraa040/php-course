<?php

session_start();

class DB
{
    protected $dbhost;
    protected $dbType;
    protected $dbName;
    protected $userName;
    protected $password;
    protected $connection;

    function __construct($host, $type, $dbname, $uName, $pass)
    {
        $this->dbhost   = $host;
        $this->dbType   = $type;
        $this->dbName   = $dbname;
        $this->userName = $uName;
        $this->password = $pass;

        $this->connection = new PDO(
            "$this->dbType:host=$this->dbhost;dbname=$this->dbName",
            $this->userName,
            $this->password
        );

        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function index($table)
    {
        $query    = "select * from $table";
        $sqlQuery = $this->connection->prepare($query);
        $sqlQuery->execute();

        return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
    }

    function show($table, $id, $key = "id")
    {
        $query    = "select * from $table where $key = :id";
        $sqlQuery = $this->connection->prepare($query);
        $sqlQuery->execute([":id" => $id]);

        return $sqlQuery->fetch(PDO::FETCH_ASSOC);
    }

    function findBy($table, $column, $value)
    {
        $query    = "select * from $table where $column = :value";
        $sqlQuery = $this->connection->prepare($query);
        $sqlQuery->execute([":value" => $value]);

        return $sqlQuery->fetch(PDO::FETCH_ASSOC);
    }

    function create($table, $data)
    {
        $columns      = implode(",", array_keys($data));
        $placeholders = ":" . implode(",:", array_keys($data));

        $query    = "insert into $table ($columns) values ($placeholders)";
        $sqlQuery = $this->connection->prepare($query);

        $values = [];
        foreach ($data as $column => $value) {
            $values[":" . $column] = $value;
        }

        return $sqlQuery->execute($values);
    }

    function update($table, $id, $data, $key = "id")
    {
        $sets = [];
        foreach ($data as $column => $value) {
            $sets[] = "$column = :$column";
        }

        $query    = "update $table set " . implode(",", $sets) . " where $key = :primaryKey";
        $sqlQuery = $this->connection->prepare($query);

        $values = [];
        foreach ($data as $column => $value) {
            $values[":" . $column] = $value;
        }
        $values[":primaryKey"] = $id;

        return $sqlQuery->execute($values);
    }

    function delete($table, $id, $key = "id")
    {
        $query    = "delete from $table where $key = :id";
        $sqlQuery = $this->connection->prepare($query);

        return $sqlQuery->execute([":id" => $id]);
    }
}

$db = new DB("localhost", "mysql", "iti_sm_php_g2_2026", "root", "");
