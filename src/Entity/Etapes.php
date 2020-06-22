<?php

namespace App\Entity;

use App\Repository\EtapesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtapesRepository::class)
 */
class Etapes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numEtape;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptionEtape;

    /**
     * @ORM\ManyToOne(targetEntity=Recettes::class, inversedBy="etapes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recette;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumEtape(): ?int
    {
        return $this->numEtape;
    }

    public function setNumEtape(int $numEtape): self
    {
        $this->numEtape = $numEtape;

        return $this;
    }

    public function getDescriptionEtape(): ?string
    {
        return $this->descriptionEtape;
    }

    public function setDescriptionEtape(string $descriptionEtape): self
    {
        $this->descriptionEtape = $descriptionEtape;

        return $this;
    }

    public function getRecette(): ?Recettes
    {
        return $this->recette;
    }

    public function setRecette(?Recettes $recette): self
    {
        $this->recette = $recette;

        return $this;
    }
}
