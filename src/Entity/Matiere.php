<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatiereRepository::class)
 */
class Matiere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $name_matiere;

    /**
     * @ORM\Column(type="integer")
     */
    private $heure_de_cours;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameMatiere(): ?string
    {
        return $this->name_matiere;
    }

    public function setNameMatiere(string $name_matiere): self
    {
        $this->name_matiere = $name_matiere;

        return $this;
    }

    public function getHeureDeCours(): ?int
    {
        return $this->heure_de_cours;
    }

    public function setHeureDeCours(int $heure_de_cours): self
    {
        $this->heure_de_cours = $heure_de_cours;

        return $this;
    }
}
