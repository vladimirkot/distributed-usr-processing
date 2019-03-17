<?php

namespace App\Controller;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;


class UsersController extends AbstractController
{
    public function list(SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $data = (new Class{
                            public $firstName="John";
                            public $lastName="Smith";
                            public $phoneNumbers=["812 123-1234","916 123-4567"];
        });

        $jsonData = json_encode($data);

        dump($jsonData);

        $user = $serializer->deserialize($jsonData, User::class, "json");

        dump($user);

        return $this->render('users/list.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }

    public function search()
    {
        return $this->render('users/search.html.twig', []);
    }
}
