<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 2019-03-19
 * Time: 08:09
 */

namespace App\SearchEngine;

use App\Entity\User;
use Psr\Log\LoggerInterface;


class UsersIndex
{
    private $connection;
    private $indexName;
    private $logger;

    public function __construct(ConnectionInterface $connection, string $indexName, LoggerInterface $logger)
    {
        $this->connection = $connection;
        $this->indexName  = $indexName;
        $this->logger     = $logger;
    }

    /**
     * add user info to index
     * @param User $user
     * @return int modified records count
     */
    public function add(User $user)
    {
        try{
            $sql = sprintf("INSERT INTO %s(id,first_name,last_name) VALUES(%u,'%s','%s')",
                $this->indexName,
                $user->getId(),
                $user->getFirstName(),
                $user->getLastName());

            $result = $this->connection->exec($sql);
        }
        catch (\Exception $e){
            $this->logger->error($e);
            $result = 0;
        }

        return $result;
    }

    public function search(?string $term = null):array
    {
        $sql = sprintf("SELECT * FROM %s WHERE MATCH('@first_name %%%s%%')", $this->indexName, $term);

        try{
            $searchResult = $this->connection->query($sql);

            $ids = array_column($searchResult, "id");
        }
        catch (\Exception $e){
            $this->logger->error($e);
            $ids = [];
        }

        return $ids;
    }
}