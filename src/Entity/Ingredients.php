<?php

namespace App\Entity;

use App\Repository\IngredientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientsRepository::class)
 */
class Ingredients
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomIngredient;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $couleur;

    /**
     * @ORM\OneToMany(targetEntity=Compose::class, mappedBy="ingredient")
     */
    private $composes;

    public function __construct()
    {
        $this->composes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomIngredient(): ?string
    {
        return $this->nomIngredient;
    }

    public function setNomIngredient(string $nomIngredient): self
    {
        $this->nomIngredient = $nomIngredient;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(?string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * @return Collection|Compose[]
     */
    public function getComposes(): Collection
    {
        return $this->composes;
    }

    public function addCompose(Compose $compose): self
    {
        if (!$this->composes->contains($compose)) {
            $this->composes[] = $compose;
            $compose->setIngredient($this);
        }

        return $this;
    }

    public function removeCompose(Compose $compose): self
    {
        if ($this->composes->contains($compose)) {
            $this->composes->removeElement($compose);
            // set the owning side to null (unless already changed)
            if ($compose->getIngredient() === $this) {
                $compose->setIngredient(null);
            }
        }

        return $this;
    }
}
