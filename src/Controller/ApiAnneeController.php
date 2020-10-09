<?php

namespace App\Controller;

use App\Entity\Annee;
use App\Repository\AnneeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class ApiAnneeController extends AbstractController
{
    /**
     * @Route("/api/annee", name="api_annee", methods={"GET"})
     */
    public function index()
    {
        return $this->render('api_annee/index.html.twig', [
            'controller_name' => 'ApiAnneeController',
        ]);
    }

    /**
     * @Route("/api/annee", name="api_annee", methods={"POST"})
     */
    public function new(Request $request, EntityManagerInterface $em,SerializerInterface $serializer, ValidatorInterface $valid)
    {
        $receivedJson = $request->getContent();

        try{
            $Annee = $serializer->deserialize($receivedJson,Annee::class,'json');
            

            $errors= $valid->validate($Annee);

            if(count($errors)>0){
                return $this->json($errors,400);
            }

            $em->persist($Annee);
            $em->flush();

            return $this->json($Annee,201);
        }catch(NotEncodableValueException $err){
            return $this->json([
                'status'=> 400,
                'message'=>$err->getMessage()
            ],400);
        }

    }

    /**
     * @Route("/api/annee/{id]", name="api_annee_edit", methods={"PUT,PATCH"})
     */
    public function edit($id, Request $request, EntityManagerInterface $em, AnneeRepository $anneeRepository, SerializerInterface $serializer)
    {
        $annee = $anneeRepository->find($id);
        $data = $serializer->deserialize($request->getContent(),Annee::class,'json');

        $annee->setNom($data->getNom);

        $em->flush();
    }
}
