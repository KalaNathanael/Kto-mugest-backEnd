<?php

namespace App\Entity;

use App\Repository\PretRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PretRepository::class)
 */
class Pret
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
    private $montantPlafond;

    /**
     * @ORM\OneToMany(targetEntity=MembrePret::class, mappedBy="pret")
     */
    private $membrePrets;

    public function __construct()
    {
        $this->membrePrets = new ArrayCollection();
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

    public function getMontantPlafond(): ?string
    {
        return $this->montantPlafond;
    }

    public function setMontantPlafond(string $montantPlafond): self
    {
        $this->montantPlafond = $montantPlafond;

        return $this;
    }

    /**
     * @return Collection|MembrePret[]
     */
    public function getMembrePrets(): Collection
    {
        return $this->membrePrets;
    }

    public function addMembrePret(MembrePret $membrePret): self
    {
        if (!$this->membrePrets->contains($membrePret)) {
            $this->membrePrets[] = $membrePret;
            $membrePret->setPret($this);
        }

        return $this;
    }

    public function removeMembrePret(MembrePret $membrePret): self
    {
        if ($this->membrePrets->contains($membrePret)) {
            $this->membrePrets->removeElement($membrePret);
            // set the owning side to null (unless already changed)
            if ($membrePret->getPret() === $this) {
                $membrePret->setPret(null);
            }
        }

        return $this;
    }
}
