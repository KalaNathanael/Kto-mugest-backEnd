<?php

namespace App\Entity;

use App\Repository\CotisationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=CotisationRepository::class)
 */
class Cotisation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $montant;

    /**
     * @ORM\Column(type="date")
     * @Groups("user:read")
     */
    private $dateCotisation;

    /**
     * @ORM\Column(type="object")
     * @Groups("user:read")
     */
    private $annee;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="cotisationVersee")
     */
    private $membre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateCotisation(): ?\DateTimeInterface
    {
        return $this->dateCotisation;
    }

    public function setDateCotisation(\DateTimeInterface $dateCotisation): self
    {
        $this->dateCotisation = $dateCotisation;

        return $this;
    }

    public function getAnnee()
    {
        return $this->annee;
    }

    public function setAnnee($annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): self
    {
        $this->membre = $membre;

        return $this;
    }
}
