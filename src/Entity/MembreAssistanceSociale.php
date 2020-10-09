<?php

namespace App\Entity;

use App\Repository\MembreAssistanceSocialeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MembreAssistanceSocialeRepository::class)
 */
class MembreAssistanceSociale
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups("user:read")
     */
    private $dateOperation;

    /**
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $montant;

    /**
     * @ORM\ManyToOne(targetEntity=AssistanceSociale::class, inversedBy="membreAssistanceSociales")
     */
    private $assistanceSociale;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="membreAssistanceSociales")
     */
    private $membres;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOperation(): ?\DateTimeInterface
    {
        return $this->dateOperation;
    }

    public function setDateOperation(\DateTimeInterface $dateOperation): self
    {
        $this->dateOperation = $dateOperation;

        return $this;
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

    public function getAssistanceSociale(): ?AssistanceSociale
    {
        return $this->assistanceSociale;
    }

    public function setAssistanceSociale(?AssistanceSociale $assistanceSociale): self
    {
        $this->assistanceSociale = $assistanceSociale;

        return $this;
    }

    public function getMembres(): ?Membre
    {
        return $this->membres;
    }

    public function setMembres(?Membre $membres): self
    {
        $this->membres = $membres;

        return $this;
    }
}
