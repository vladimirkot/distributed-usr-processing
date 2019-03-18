<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 2019-03-18
 * Time: 09:12
 */

namespace App\Consumer;

use PhpAmqpLib\Message\AMQPMessage;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Controller\ApiController;
use App\Producer\UsersIndexProducer;

class UsersCreateConsumer
{
    private $serializer;
    private $indexProducer;
    private $entityManager;

    public function __construct(SerializerInterface $serializer,
                                UsersIndexProducer $indexProducer,
                                EntityManagerInterface $entityManager
                                )
    {
        $this->serializer = $serializer;
        $this->indexProducer = $indexProducer;
        $this->entityManager = $entityManager;
    }

    public function execute(AMQPMessage $message)
    {
        try {
            $user = $this->serializer->deserialize($message->getBody(), User::class, ApiController::FORMAT);

            /*@todo maybe pass this to user`s denormalizer */
            foreach($user->getPhoneNumbers() as $phoneNumber){
                $phoneNumber->setUser($user);
            }

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->indexProducer->publish($message->getBody());
            echo json_encode($user).PHP_EOL;
        } catch (Exception $e) {
            \error_log($e);
        }
    }
}