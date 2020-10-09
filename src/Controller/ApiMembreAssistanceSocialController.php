<?php

namespace App\Controller;

use App\Entity\MembreAssistanceSociale;
use App\Repository\AssistanceSocialeRepository;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiMembreAssistanceSocialController extends AbstractController
{
    /**
     * @Route("/api/user/{id}/assistance/{a_id}", name="api_membre_assistance_social", methods = {"POST"})
     * @Entity("assistanceSociale", expr="repository.find(a_id)")
     */
    public function enregistrer($id, $a_id,AssistanceSocialeRepository $assistanceSocialeRepository,Request $request, SerializerInterface $serializer, ValidatorInterface $valid, EntityManagerInterface $em, MembreRepository $membreRepository)
    {
        $data = $serializer->deserialize($request->getContent(),MembreAssistanceSociale::class,'json');
        $membre = $membreRepository->find($id);
        $assistanceSociale = $assistanceSocialeRepository->find($a_id);
        if($membre)
        {
            if($a_id)
            {
                $data->setMembres($membre);
                $data->setAssistanceSociale($assistanceSociale);
            }
        }

        $errors = $valid->validate($data);

        if(count($errors))
        {
            return $this->json($errors,404);
        }else{
            $em->persist($data);
            $em->flush();
            return $this->json($data,201,[],['groups'=>'user:read']);
        }
    }

}
