<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends AbstractController
{

    public function users_create()
    {
        return new Response(json_encode(["create_info"=>["method"=>__METHOD__]]));
    }

    public function users_get()
    {
        return new Response(json_encode(["get_info"=>["method"=>__METHOD__]]));
    }
}
