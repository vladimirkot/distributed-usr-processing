<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 2019-03-18
 * Time: 00:02
 */

namespace App\Normalizer;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use App\Entity\PhoneNumber;
use Doctrine\Common\Collections\ArrayCollection;


class PhoneNumberNormalizer extends ObjectNormalizer
{
    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return strpos($type, 'App\\Entity\\PhoneNumber[]') === 0 && (is_array($data) || is_string($data));
    }
    /**
     * @inheritDoc
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $data = (array)$data;

        $result = new ArrayCollection();

        foreach($data as $phoneNo){

            $phoneNumber = new PhoneNumber();

            switch (gettype($phoneNo)){
                case "string":
                    $phoneNumber->setPhoneNo($phoneNo);
                    break;
                case "array":
                    $phoneNumber->setPhoneNo($phoneNo["phoneNo"]);
                    $phoneNumber->setId($phoneNo["id"]);
                    break;
            }


            $result->add($phoneNumber);
        }

        return $result;
    }
}