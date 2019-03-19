<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\SearchEngine\UsersIndex;
use Symfony\Component\HttpFoundation\Request;


class UsersController extends AbstractController
{
    public function index(Request $request, EntityManagerInterface $em, UsersIndex $usersIndex)
    {

        $term = $request->query->get("term");
        $sort = $request->query->get("sort");

        if(!empty($term)){
            $ids = $usersIndex->search($term);

            $users = $em->getRepository(User::class)->findById($ids);

            array_map(function(User $user)use($term){
                $term = ucfirst($term);
                $highlightedFirstName = str_replace($term, "<b>{$term}</b>", $user->getFirstName());
                $user->setFirstName($highlightedFirstName);
            },
                $users);
        }
        elseif(!empty($sort)){
            $users = $em->getRepository(User::class)->findBy([], ['firstName' => $sort]);
        }
        else{
            $users = $em->getRepository(User::class)->findAll();
        }



        return $this->render('users/index.html.twig', [
            "users" => $users, "sort" => $sort, "term" => $term
        ]);
    }

    public function search(Request $request, EntityManagerInterface $em, UsersIndex $usersIndex)
    {
        $term = $request->query->get("term");

        $ids = $usersIndex->search($term);

        $foundUsers = $em->getRepository(User::class)->findById($ids);

        array_map(function(User $user)use($term){
                $highlightedFirstName = str_replace(ucfirst($term), "<b>{$term}</b>", $user->getFirstName());
                $user->setFirstName($highlightedFirstName);
            },
            $foundUsers);

        return $this->render('users/search.html.twig', ['term'=>ucfirst($term), 'users'=>$foundUsers]);
    }
}
