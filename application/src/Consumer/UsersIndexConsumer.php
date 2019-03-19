<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 2019-03-18
 * Time: 09:13
 */

namespace App\Consumer;

use PhpAmqpLib\Message\AMQPMessage;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Controller\ApiController;
use App\SearchEngine\UsersIndex;

class UsersIndexConsumer
{
    private $serializer;
    private $usersIndex;

    public function __construct(SerializerInterface $serializer, UsersIndex $usersIndex)
    {
        $this->serializer = $serializer;
        $this->usersIndex = $usersIndex;
    }

    public function execute(AMQPMessage $message)
    {
        try {
            $user = $this->serializer->deserialize($message->getBody(), User::class, ApiController::FORMAT);

            $this->usersIndex->add($user);
        } catch (Exception $e) {
            \error_log($e);
        }
    }
}