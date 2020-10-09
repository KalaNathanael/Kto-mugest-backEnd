<?php

namespace App\Entity;

use App\Repository\MembreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=MembreRepository::class)
 */
class Membre
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
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     */
    private $motDePasse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $age;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     */
    private $personnel;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     */
    private $statut;

    /**
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $cotisation;

    /**
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $nombreEnfants;

    /**
     * @ORM\OneToMany(targetEntity=MembrePret::class, mappedBy="membre")
     */
    private $membrePret;

    /**
     * @ORM\OneToMany(targetEntity=Ceremonie::class, mappedBy="membre")
     */
    private $ceremonies;

    /**
     * @ORM\OneToMany(targetEntity=Cotisation::class, mappedBy="membre")
     */
    private $cotisationVersee;

    /**
     * @ORM\OneToMany(targetEntity=MembreAssistanceSociale::class, mappedBy="membres")
     */
    private $membreAssistanceSociales;

    /**
     * @ORM\OneToMany(targetEntity=MembreBureau::class, mappedBy="membres")
     */
    private $membreBureaus;


   
    public function __construct()
    {
        $this->membrePret = new ArrayCollection();
        $this->ceremonies = new ArrayCollection();
        $this->cotisationVersee = new ArrayCollection();
        $this->membreAssistanceSociales = new ArrayCollection();
        $this->membreBureaus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPersonnel(): ?string
    {
        return $this->personnel;
    }

    public function setPersonnel(string $personnel): self
    {
        $this->personnel = $personnel;

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

    public function getCotisation(): ?int
    {
        return $this->cotisation;
    }

    public function setCotisation(int $cotisation): self
    {
        $this->cotisation = $cotisation;

        return $this;
    }

    public function getNombreEnfants(): ?int
    {
        return $this->nombreEnfants;
    }

    public function setNombreEnfants(int $nombreEnfants): self
    {
        $this->nombreEnfants = $nombreEnfants;

        return $this;
    }

    /**
     * @return Collection|MembrePret[]
     */
    public function getMembrePret(): Collection
    {
        return $this->membrePret;
    }

    public function addMembrePret(MembrePret $membrePret): self
    {
        if (!$this->membrePret->contains($membrePret)) {
            $this->membrePret[] = $membrePret;
            $membrePret->setMembre($this);
        }

        return $this;
    }

    public function removeMembrePret(MembrePret $membrePret): self
    {
        if ($this->membrePret->contains($membrePret)) {
            $this->membrePret->removeElement($membrePret);
            // set the owning side to null (unless already changed)
            if ($membrePret->getMembre() === $this) {
                $membrePret->setMembre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ceremonie[]
     */
    public function getCeremonies(): Collection
    {
        return $this->ceremonies;
    }

    public function addCeremony(Ceremonie $ceremony): self
    {
        if (!$this->ceremonies->contains($ceremony)) {
            $this->ceremonies[] = $ceremony;
            $ceremony->setMembre($this);
        }

        return $this;
    }

    public function removeCeremony(Ceremonie $ceremony): self
    {
        if ($this->ceremonies->contains($ceremony)) {
            $this->ceremonies->removeElement($ceremony);
            // set the owning side to null (unless already changed)
            if ($ceremony->getMembre() === $this) {
                $ceremony->setMembre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Cotisation[]
     */
    public function getCotisationVersee(): Collection
    {
        return $this->cotisationVersee;
    }

    public function addCotisationVersee(Cotisation $cotisationVersee): self
    {
        if (!$this->cotisationVersee->contains($cotisationVersee)) {
            $this->cotisationVersee[] = $cotisationVersee;
            $cotisationVersee->setMembre($this);
        }

        return $this;
    }

    public function removeCotisationVersee(Cotisation $cotisationVersee): self
    {
        if ($this->cotisationVersee->contains($cotisationVersee)) {
            $this->cotisationVersee->removeElement($cotisationVersee);
            // set the owning side to null (unless already changed)
            if ($cotisationVersee->getMembre() === $this) {
                $cotisationVersee->setMembre(null);
            }
        }

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
            $membreAssistanceSociale->setMembres($this);
        }

        return $this;
    }

    public function removeMembreAssistanceSociale(MembreAssistanceSociale $membreAssistanceSociale): self
    {
        if ($this->membreAssistanceSociales->contains($membreAssistanceSociale)) {
            $this->membreAssistanceSociales->removeElement($membreAssistanceSociale);
            // set the owning side to null (unless already changed)
            if ($membreAssistanceSociale->getMembres() === $this) {
                $membreAssistanceSociale->setMembres(null);
            }
        }

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
            $membreBureau->setMembres($this);
        }

        return $this;
    }

    public function removeMembreBureau(MembreBureau $membreBureau): self
    {
        if ($this->membreBureaus->contains($membreBureau)) {
            $this->membreBureaus->removeElement($membreBureau);
            // set the owning side to null (unless already changed)
            if ($membreBureau->getMembres() === $this) {
                $membreBureau->setMembres(null);
            }
        }

        return $this;
    }

    

    }
