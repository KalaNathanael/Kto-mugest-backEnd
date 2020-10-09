<?php

namespace App\Controller;

use App\Entity\Bureau;
use App\Repository\BureauRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiBureauController extends AbstractController
{
    
    /**
     * @Route("/api/bureau", name="api_bureau_new", methods={"POST"})
     */
    public function enregistrer(Request $request, SerializerInterface $serializer, ValidatorInterface $valid, EntityManagerInterface $em)
    {
        try
        {
            $data = $serializer->deserialize($request->getContent(),Bureau::class,'json');

            $errors= $valid->validate($data);

            if(count($errors)>0){
                return $this->json($errors,400);
            }else{
                $em->persist($data);
                $em->flush();
                return $this->json($data,201,[],['groups'=>'user:read']);
            }
        } catch(NotEncodableValueException $err)
        {
            return $this->json([
                'status'=> 400,
                'message'=>$err->getMessage()
            ],400);
        }
        
    }

    
}
