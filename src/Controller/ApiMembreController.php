<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Repository\CeremonieRepository;
use App\Repository\CotisationRepository;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiMembreController extends AbstractController
{
    /**
     * @Route("/api/users", name="api_user_index", methods={"GET"})
     */
    public function consulter(MembreRepository $membreRepository)
    {
        return $this->json($membreRepository->findAll(),200,[],['groups'=>'user:read']);
    }


    /**
     * @Route("/api/user", name= "api_user_new", methods={"POST"})
     */
    public function enregistrer(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $valid)
    {
        $receivedJson = $request->getContent();
        try{
            $member = $serializer->deserialize($receivedJson,Membre::class,'json');
            $errors= $valid->validate($member);

            if(count($errors)>0){
                return $this->json($errors,400);
            }else{
                $em->persist($member);
                $em->flush();
            }

            
            return $this->json($member,201,[],['groups'=>'user:read']);
        }catch(NotEncodableValueException $err){
            return $this->json([
                'status'=> 400,
                'message'=>$err->getMessage()
            ],400);
        }
    }

    /**
     * @Route("/api/user/{id}", name= "api_user_show", methods={"GET"})
     */
    public function retrieve($id, MembreRepository $membreRepository)
    {
        return $this->json($membreRepository->find($id),200,[],['groups'=>'user:read']);
    }


    /**
     * @Route("/api/user/{id}", name= "api_member_delete", methods={"DELETE"})
     */
    public function desactiver($id, MembreRepository $membreRepository, EntityManagerInterface $em):Response
    {
        $member=$membreRepository->find($id);
        if($member)
        {
            $em->remove($member);
            $em->flush();
        }else {
            return $this->json([
                'status'=> 404,
                'message'=>'This post does not exist'
            ],404);
        }

        return $this->json([
            'status'=>'204',
            'message'=>'This post was deleted successfully'
        ],204);
    }


    /**
     * @Route("/api/user/{id}", name= "api_user_edit", methods={"PUT","PATCH"})
     */
    public function edit($id, Request $request, MembreRepository $membreRepository, SerializerInterface $serializer,EntityManagerInterface $em, ValidatorInterface $valid)
    {
        $membre = $membreRepository->findOneById($id);
        $data = $serializer->deserialize($request->getContent(),Membre::class,'json');
        $membre->setUsername($data->getUsername());
        $membre->setMotDePasse($data->getMotDePasse());
        $membre->setNom($data->getNom());
        $membre->setPrenom($data->getPrenom());
        $membre->setAge($data->getAge());
        $membre->setEmail($data->getEmail());
        $membre->setPersonnel($data->getPersonnel());
        $membre->setStatut($data->getStatut());
        $membre->setCotisation($data->getCotisation());
        $membre->setNombreEnfants($data->getNombreEnfants());
        
    
        $em->flush();

        return $this->json($membre,200,[],['groups'=>'user:read']);
    }



    /**
     * @Route("/api/user/{id}/cotisation", name= "api_user_cotisation", methods={"GET"})
     */
    public function findMemberCotisation($id,CotisationRepository $cotisation)
    {
        $cotisations=$cotisation->findCotisation($id);
        if ($cotisations)
        {
            return $this->json($cotisations,200,[],['groups'=>'user:read']);
        }else{
            return $this->json([
                'status'=>'404',
                'message'=>'Ce membre n/a pas encore cotisé'
            ],404);
        }
    }

/**
     * @Route("/api/user/{id}/ceremonie", name= "api_user_ceremonie", methods={"GET"})
     */
    public function findMemberCeremonie($id,CeremonieRepository $ceremonie)
    {
        $ceremonies=$ceremonie->findCeremonie($id);
        if ($ceremonies)
        {
            return $this->json($ceremonies,200,[],['groups'=>'user:read']);
        }else{
            return $this->json([
                'status'=>'404',
                'message'=>'Ce membre ne supervise aucune cérémonie'
            ],404);
        }
    }

    /**
     * @Route("/api/user/auth", name= "api_user_auth", methods={"GET"})
     */
    public function auth(MembreRepository $membreRepository, Request $request, SerializerInterface $serializer)
    {
        $data = $serializer->deserialize($request->getContent(),Membre::class,'json');
        $username = $membreRepository->findOneByUsername($data->getUsername());
        $password = $membreRepository->findOneByPass($data->getMotDePasse());
        
        if ($username) {
            if($password)
            {
                return $this->redirectToRoute('api_user_menu',[],302);
            } else {
                return $this->json([
                    'status'=>'200',
                    'message'=>'Mot de passe erroné'
                ],200);
            }
        } else {
            $this->json([
                'status'=>'200',
                'message'=>'Nom d utilisateur erroné'
            ],200);
        }
        
    }
         
    /**
     * @Route("/api/auth/password", name= "api_user_forgotten_password", methods={"GET"})
     */
    public function ForgottenPass(Request $request, MembreRepository $membreRepository)
    {
        $data=$request->getContent();
        $user=$membreRepository->findOneByEmail($data);

        if($user)
        {
            $newPass = random_bytes(10);
            $user->setMotDePasse($newPass);
        }
    }
        
}
