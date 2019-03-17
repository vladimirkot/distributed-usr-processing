<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersController extends AbstractController
{
    public function list()
    {
        return $this->render('users/list.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }

    public function search()
    {
        return $this->render('users/search.html.twig', []);
    }
}
