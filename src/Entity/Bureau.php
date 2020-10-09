<?php

namespace App\Entity;

use App\Repository\BureauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=BureauRepository::class)
 */
class Bureau
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
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     * @Groups("user:read")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     */
    private $statut;

    /**
     * @ORM\OneToMany(targetEntity=MembreBureau::class, mappedBy="bureau")
     */
    private $membreBureaus;

    public function __construct()
    {
        $this->membreBureaus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection|MembreBureau[]
     */
    public function getMembreBureaus(): Collection
    {
        return $this->membreBureaus;
    }

    public function addMembreBureau(MembreBureau $membreBureau): self
    {
        if (!$this->membreBureaus->contains($membreBureau)) {
            $this->membreBureaus[] = $membreBureau;
            $membreBureau->setBureau($this);
        }

        return $this;
    }

    public function removeMembreBureau(MembreBureau $membreBureau): self
    {
        if ($this->membreBureaus->contains($membreBureau)) {
            $this->membreBureaus->removeElement($membreBureau);
            // set the owning side to null (unless already changed)
            if ($membreBureau->getBureau() === $this) {
                $membreBureau->setBureau(null);
            }
        }

        return $this;
    }
}
