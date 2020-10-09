<?php

namespace App\Entity;

use App\Repository\MembrePretRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MembrePretRepository::class)
 */
class MembrePret
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
    private $echeance;

    /**
     * @ORM\ManyToOne(targetEntity=Pret::class, inversedBy="membrePrets")
     */
    private $pret;

    /**
     * @ORM\OneToMany(targetEntity=Remboursement::class, mappedBy="membrePret")
     */
    private $remboursementPret;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="membrePret")
     */
    private $membre;

    public function __construct()
    {
        $this->remboursementPret = new ArrayCollection();
    }

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

    public function getEcheance(): ?\DateTimeInterface
    {
        return $this->echeance;
    }

    public function setEcheance(\DateTimeInterface $echeance): self
    {
        $this->echeance = $echeance;

        return $this;
    }

    public function getPret(): ?Pret
    {
        return $this->pret;
    }

    public function setPret(?Pret $pret): self
    {
        $this->pret = $pret;

        return $this;
    }

    /**
     * @return Collection|Remboursement[]
     */
    public function getRemboursementPret(): Collection
    {
        return $this->remboursementPret;
    }

    public function addRemboursementPret(Remboursement $remboursementPret): self
    {
        if (!$this->remboursementPret->contains($remboursementPret)) {
            $this->remboursementPret[] = $remboursementPret;
            $remboursementPret->setMembrePret($this);
        }

        return $this;
    }

    public function removeRemboursementPret(Remboursement $remboursementPret): self
    {
        if ($this->remboursementPret->contains($remboursementPret)) {
            $this->remboursementPret->removeElement($remboursementPret);
            // set the owning side to null (unless already changed)
            if ($remboursementPret->getMembrePret() === $this) {
                $remboursementPret->setMembrePret(null);
            }
        }

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
