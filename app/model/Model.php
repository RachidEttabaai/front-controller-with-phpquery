<?php

namespace App\Model;

use PDO;
use PDOException;

class Model implements Db
{
    
    protected $pdo;

    public function __construct()
    {
        $this->pdo = $this->connect(
            Db::DB_DNS,
            Db::DB_USER,
            Db::DB_PWD,
            Db::DB_OPTIONS
        );
        
    }

    public function connect(string $dns, string $user = '', string $pwd = '', array $options = []): ?PDO
    {
        try {
            $connect = new PDO($dns, $user, $pwd, $options);
        } catch (PDOException $ex) {
            die("Error while connection to the database !!!!!" . $ex->getMessage());
        }

        return $connect;
    }

    public function selectquery(string $selectsqlquery): array
    {
        $stmtselect = $this->pdo->query($selectsqlquery);
        $stmtselect->execute();
        $getresquery = $stmtselect->fetchAll();
        $stmtselect->closeCursor();
        return $getresquery;
    }

    public function countquery(string $countsqlquery): int
    {
        $stmtcount = $this->pdo->prepare($countsqlquery);
        $stmtcount->execute();
        $countcountries = $stmtcount->columnCount();
        $stmtcount->closeCursor();
        return $countcountries;
    }

    public function insertquery(string $insertsqlquery, array $datas): void
    {
        $stmtinsert = $this->pdo->prepare($insertsqlquery);
        $stmtinsert->execute($datas);
        $stmtinsert->closeCursor();
    }
}
