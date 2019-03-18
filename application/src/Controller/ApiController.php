<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Producer\UsersCreateProducer;

class ApiController extends AbstractController
{
    const JSON_CONTENT_TYPE = 'application/json';
    const FORMAT = 'json';

    public function users_create(
        Request $request,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        UsersCreateProducer $producer
    )
    {

        $inputFormat = $request->headers->has('Content-Type')?$request->headers->get('Content-Type'):self::JSON_CONTENT_TYPE;
        if (self::JSON_CONTENT_TYPE !== $inputFormat) {
            return new Response('Can`t process. Content-Type should be ' . self::JSON_CONTENT_TYPE,
                Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
        }

        $user = $serializer->deserialize($request->getContent(), User::class, self::FORMAT);

        $errors = $validator->validate($user);

        if (count($errors) > 0) {

            $errorsString = (string) $errors;

            return new Response($errorsString, Response::HTTP_BAD_REQUEST);
        }

        try{
            $producer->publish($request->getContent());
            return new Response("success", Response::HTTP_CREATED);
        }
        catch(\Exception $e){
            return new Response("Fail", Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function users_get()
    {
        return new Response(json_encode(["get_info"=>["method"=>__METHOD__]]));
    }
}
