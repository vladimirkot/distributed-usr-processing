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

class UsersIndexConsumer
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function execute(AMQPMessage $message)
    {
        try {
            $user = $this->serializer->deserialize($message->getBody(), User::class, ApiController::FORMAT);
            echo json_encode($user).PHP_EOL;
        } catch (Exception $e) {
            \error_log($e);
        }
    }
}