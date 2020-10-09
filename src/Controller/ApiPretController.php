<?php

namespace App\Controller;

use App\Entity\Pret;
use App\Repository\PretRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiPretController extends AbstractController
{
    /**
     * @Route("/api/pret", name="api_pret_new", methods={"POST"})
     */
    public function enregistrer(Request $request, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $data = $serializer->deserialize($request->getContent(),Pret::class,'json');
        $em->persist($data);
        $em->flush();
        return $this->json($data,201,[],['groups'=>'user:read']);
    }

   
}
