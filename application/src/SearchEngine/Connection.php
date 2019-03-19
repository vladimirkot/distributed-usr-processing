<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 2019-03-19
 * Time: 08:09
 */

namespace App\SearchEngine;


class Connection implements ConnectionInterface
{
    private $handler;

    public function __construct(string $dsn)
    {
        $this->handler = new \PDO($dsn);
    }

    public function query(string $statement):?array
    {
        $stmt = $this->handler->query($statement);

        if(empty($stmt)){
            throw new \Exception(implode(";", $this->handler->errorInfo()));
        }

        return $stmt->fetchAll();
    }

    public function exec(string $statement)
    {

        $result = $this->handler->query($statement);

        if(empty($result)){
            throw new \Exception(implode(";", $this->handler->errorInfo()));
        }

        return $result;
    }
}