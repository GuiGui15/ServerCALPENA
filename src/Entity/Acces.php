<?php

namespace App\Entity;

use App\Repository\AccesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccesRepository::class)
 */
class Acces
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateurs::class, inversedBy="acces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Utile;

    /**
     * @ORM\ManyToOne(targetEntity=Autorisation::class, inversedBy="acces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Auto;

    /**
     * @ORM\ManyToOne(targetEntity=Documents::class, inversedBy="acces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Doc;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtile(): ?Utilisateurs
    {
        return $this->Utile;
    }

    public function setUtile(?Utilisateurs $Utile): self
    {
        $this->Utile = $Utile;

        return $this;
    }

    public function getAuto(): ?Autorisation
    {
        return $this->Auto;
    }

    public function setAuto(?Autorisation $Auto): self
    {
        $this->Auto = $Auto;

        return $this;
    }

    public function getDoc(): ?Documents
    {
        return $this->Doc;
    }

    public function setDoc(?Documents $Doc): self
    {
        $this->Doc = $Doc;

        return $this;
    }
}
