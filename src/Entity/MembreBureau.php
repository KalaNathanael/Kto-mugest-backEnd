<?php

namespace App\Entity;

use App\Repository\MembreBureauRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MembreBureauRepository::class)
 */
class MembreBureau
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     */
    private $poste;

    
    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="membreBureaus")
     */
    private $membres;

    /**
     * @ORM\ManyToOne(targetEntity=Bureau::class, inversedBy="membreBureaus")
     */
    private $bureau;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

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

    public function getBureau(): ?Bureau
    {
        return $this->bureau;
    }

    public function setBureau(?Bureau $bureau): self
    {
        $this->bureau = $bureau;

        return $this;
    }
}
