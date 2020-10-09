<?php

namespace App\Controller;

use App\Entity\MembrePret;
use App\Repository\MembreRepository;
use App\Repository\PretRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

class ApiMembrePretController extends AbstractController
{
    /**
     * @Route("/api/user/{membre_id}/pret/{pret_id}", name="api_membre_pret", methods = {"POST"})
     * @Entity("pret", expr="repository.find(pret_id)")
     * @Entity("membre", expr="repository.find(membre_id)")
     */
    public function enregistrer($id, $id2, PretRepository $pretRepository, MembreRepository $membreRepository, Request $request, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $data = $serializer->deserialize($request->getContent(),MembrePret::class,'json');
        $data->setPret($pretRepository->find($id2));
        $data->setMembre($membreRepository->find($id));
        $em->persist($data);
        $em->flush();
        return $this->json($data,201,[],['groups'=>'user:read']);
    }

    
}
