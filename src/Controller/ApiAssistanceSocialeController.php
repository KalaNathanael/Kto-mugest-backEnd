<?php

namespace App\Controller;

use App\Entity\AssistanceSociale;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiAssistanceSocialeController extends AbstractController
{
    /**
     * @Route("/api/assistance/sociale", name="api_assistance_sociale_new", methods={"POST"})
     */
    public function enregistrer(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $valid)
    {
       //Desérialisé le contenu en json en celui de la classe AssistanceSociale//

        $data = $serializer->deserialize($request->getContent(),AssistanceSociale::class,'json');

        //Validation des données//

        $errors = $valid->validate($data);

        if(count($errors)>0){
            return $this->json($errors,401);
        }else{

        //Enregistrement des données//
        
            $em->persist($data);
            $em->flush();
            return $this->json($data,201,[],['groups'=>'user:read']);
        }
        
    }
}
