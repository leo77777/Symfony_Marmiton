<?php

namespace App\Entity;

use App\Repository\CommentairesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CommentairesRepository::class)
 */
class Commentaires
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotNull
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $libelleCommentaire;

    /**
     * @ORM\Column(type="date")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=140, nullable=true)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $valide;

    /**
     * @ORM\ManyToOne(targetEntity=Recettes::class, inversedBy="commentaires")
     */
    private $recette;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="commentaires")
     */
    private $utilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleCommentaire(): ?string
    {
        return $this->libelleCommentaire;
    }

    public function setLibelleCommentaire(string $libelleCommentaire): self
    {
        $this->libelleCommentaire = $libelleCommentaire;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(bool $valide): self
    {
        $this->valide = $valide;

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

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
