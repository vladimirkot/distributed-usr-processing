<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 2019-03-19
 * Time: 08:34
 */

namespace App\SearchEngine;


interface ConnectionInterface
{
    public function query(string $statement):?array;

    public function exec(string $statement);
}