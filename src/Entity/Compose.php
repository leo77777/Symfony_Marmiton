<?php

namespace App\Entity;

use App\Repository\ComposeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ComposeRepository::class)
 * @UniqueEntity(fields={"recette", "ingredient"})
 */
class Compose
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Recettes::class, inversedBy="composes")
     */
    private $recette;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredients::class, inversedBy="composes")
     */
    private $ingredient;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $qteUnePersonne;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIngredient(): ?Ingredients
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredients $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getQteUnePersonne(): ?string
    {
        return $this->qteUnePersonne;
    }

    public function setQteUnePersonne(string $qteUnePersonne): self
    {
        $this->qteUnePersonne = $qteUnePersonne;

        return $this;
    }
}
