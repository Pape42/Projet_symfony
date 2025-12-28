<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

// Cette classe représente la table "livre" dans la base de données
#[ORM\Entity]
class Livre
{
    // Clé primaire du livre
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Titre du livre
    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    // Relation avec l'entité Auteur
    // Un livre est lié à un seul auteur
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Auteur $auteur = null;

    // Retourne l'id du livre
    public function getId(): ?int
    {
        return $this->id;
    }

    // Retourne le titre du livre
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    // Modifie le titre du livre
    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    // Retourne l'auteur du livre
    public function getAuteur(): ?Auteur
    {
        return $this->auteur;
    }

    // Modifie l'auteur du livre
    public function setAuteur(Auteur $auteur): self
    {
        $this->auteur = $auteur;
        return $this;
    }
}
