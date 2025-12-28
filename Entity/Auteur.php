<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

// Cette classe représente la table "auteur" en base de données
#[ORM\Entity]
class Auteur
{
    // Clé primaire
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Nom de l'auteur
    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    // Retourne l'id de l'auteur
    public function getId(): ?int
    {
        return $this->id;
    }

    // Retourne le nom de l'auteur
    public function getNom(): ?string
    {
        return $this->nom;
    }

    // Modifie le nom de l'auteur
    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }
}
