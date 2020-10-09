<?php

namespace App\Controller;

use App\Entity\Ceremonie;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiCeremonieController extends AbstractController
{
    /**
     * @Route("/api/ceremonie/{id}/user", name= "api_ceremonie_new", methods={"POST"})
     */
    public function enregistrer(Request $request, MembreRepository $membreRepository, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $valid)
    {
     
        $receivedJson = $request->getContent();
        
        try{
            $Ceremonie = $serializer->deserialize($receivedJson,Ceremonie::class,'json');
            $membre = $membreRepository->findOneByUsername($Ceremonie->getMembre());
            if($membre){
                $Ceremonie->setMembre($membre);
                
                $errors= $valid->validate($Ceremonie);

                if(count($errors)>0){
                    return $this->json($errors,400);
                }

                $em->persist($Ceremonie);
                $em->flush();
            }

            return $this->json($Ceremonie,201,[],['groups'=>'user:read']);
        }catch(NotEncodableValueException $err){
            return $this->json([
                'status'=> 400,
                'message'=>$err->getMessage()
            ],400);
        }
    }

}