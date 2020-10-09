<?php

namespace App\Controller;

use App\Entity\MembreBureau;
use App\Repository\BureauRepository;
use App\Repository\MembreBureauRepository;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ApiMembreBureauController extends AbstractController
{
    /**
     * @Route("/api/user/{id}/bureau", name="api_membre_bureau_new", methods={"POST"})
     */
    public function enregistrer($id, Request $request, SerializerInterface $serialize, BureauRepository $bureauRepository, MembreRepository $membreRepository, EntityManagerInterface $em, ValidatorInterface $valid)
    {
        $data = $serialize->deserialize($request->getContent(),MembreBureau::class,'json');
        $membre = $membreRepository->find($id);
        $bureau = $bureauRepository->findLatest();
        if($membre)
        {
            $data->setMembres($membre);
        }
        
        $data->setBureau($bureau);

        $errors = $valid->validate($data);
        if(count($errors)>0)
        {
            return $this->json($errors,404);
        }else{
            $em->persist($data);
            $em->flush();
            return $this->json($data,201,[],['groups'=>'user:read']);
        }
    }


    /**
     * @Route("/api/users/bureau", name="api_membre_bureau", methods={"GET"})
     */
    public function consulter(MembreBureauRepository $membreBureauRepository)
    {
        return $this->json($membreBureauRepository->findAll(),200,[],['groups'=>'user:read']);
    }

    /**
     * @Route("/api/user/bureau/{id}", name= "api_membre_bureau_delete", methods={"DELETE"})
     */
    public function destituer($id, MembreBureauRepository $membreBureauRepository, EntityManagerInterface $em)
    {
        $membre = $membreBureauRepository->find($id);
        if($membre)
        {
            $em->remove($membre);
            $em->flush();
        }
    }
}
