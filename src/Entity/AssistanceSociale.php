<?php

namespace App\Entity;

use App\Repository\AssistanceSocialeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AssistanceSocialeRepository::class)
 */
class AssistanceSociale
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
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     */
    private $code;

    /**
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $montantFixe;

    /**
     * @ORM\OneToMany(targetEntity=MembreAssistanceSociale::class, mappedBy="assistanceSociale")
     */
    private $membreAssistanceSociales;

    
    public function __construct()
    {
        $this->membres = new ArrayCollection();
        $this->membreAssistanceSociales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getMontantFixe(): ?int
    {
        return $this->montantFixe;
    }

    public function setMontantFixe(int $montantFixe): self
    {
        $this->montantFixe = $montantFixe;

        return $this;
    }

    /**
     * @return Collection|MembreAssistanceSociale[]
     */
    public function getMembreAssistanceSociales(): Collection
    {
        return $this->membreAssistanceSociales;
    }

    public function addMembreAssistanceSociale(MembreAssistanceSociale $membreAssistanceSociale): self
    {
        if (!$this->membreAssistanceSociales->contains($membreAssistanceSociale)) {
            $this->membreAssistanceSociales[] = $membreAssistanceSociale;
            $membreAssistanceSociale->setAssistanceSociale($this);
        }

        return $this;
    }

    public function removeMembreAssistanceSociale(MembreAssistanceSociale $membreAssistanceSociale): self
    {
        if ($this->membreAssistanceSociales->contains($membreAssistanceSociale)) {
            $this->membreAssistanceSociales->removeElement($membreAssistanceSociale);
            // set the owning side to null (unless already changed)
            if ($membreAssistanceSociale->getAssistanceSociale() === $this) {
                $membreAssistanceSociale->setAssistanceSociale(null);
            }
        }

        return $this;
    }

    }
