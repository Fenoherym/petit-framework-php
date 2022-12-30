<?php

namespace App\Models;

use App\Pdo\Connexion;

abstract class Model
{

    protected $table;
    private $conn;
    private $req;
    private  $query;
    private $count = 0;
    private int $id;

    public function __construct()
    {
        $this->conn = new Connexion();
        $this->query = "SELECT * FROM $this->table";

        $req = $this->conn->getPdo()->query("SHOW COLUMNS FROM $this->table");
        $res = $req->fetchAll();

        foreach ($res as $name) {
            $var = "$name->Field";
            $this->$var = "hahaha";
        }
    }

    public function all()
    {
        $req = $this->conn->getPdo()->query("SELECT * FROM $this->table");
        $res = $req->fetchAll();

        return $res;
    }

    public function find(int $id)
    {
        $conn = new Connexion();
        $req = $conn->getPdo()->query("SELECT * FROM $this->table WHERE id=$id");

        $res = $req->fetch();
        return $res;
    }

    public function where(string $attribut, string $operator, $value)
    {
        if ($this->count === 0) {
            $first_operateur = "WHERE";
        } else {
            $first_operateur = "AND";
        }
        $this->query .= " $first_operateur $attribut $operator '$value'";
        $this->req = $this->conn->getPdo()->query($this->query);
        $this->count++;
        return $this;
    }

    public function orWhere(string $attribut, string $operator, $value)
    {
        $this->query .= "Or $attribut $operator '$value'";
        $this->req = $this->conn->getPdo()->query($this->query);

        return $this;
    }

    public function create(array $params)
    {
        $count = 0;
        $keys = '';
        $value = '';
        $vals = [];
        foreach ($params as $param => $val) {
            $vals[$count] = $val;
            if ($count === count($params) - 1) {
                $keys .= $param;
                $value .= '?';
            } else {
                $keys .=  $param . ', ';
                $value .= '?, ';
            }


            $count++;
        }

        $conn = new Connexion();

        $req = $conn->getPDO()->prepare("INSERT INTO $this->table ($keys) VALUES ($value) ");
        return $req->execute($vals);
    }

    public function get()
    {
        return $this->req->fetchAll();
    }

    public function belongsTo(string $class_name, $key)
    {
        $class = new $class_name();
        $table = $class->table;
        $id_etranger = $this->find($id);
        return $this->conn->getPDO()->query("SELECT * FROM $table WHERE $key=$id_etranger");
    }
}
