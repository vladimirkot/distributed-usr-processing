<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 2019-03-18
 * Time: 09:32
 */

namespace App\Producer;

use OldSound\RabbitMqBundle\RabbitMq\Producer;

class UsersCreateProducer
{
    private $producer;

    public function __construct(Producer $producer)
    {
        $this->producer = $producer;
    }

    public function publish($message)
    {
        $this->producer->publish($message);
    }

}