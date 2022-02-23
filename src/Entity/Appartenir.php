<?php

namespace App\Entity;

use App\Repository\AppartenirRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppartenirRepository::class)
 */
class Appartenir
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_enseignant_ext;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_classe_ext;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEnseignantExt(): ?int
    {
        return $this->id_enseignant_ext;
    }

    public function setIdEnseignantExt(int $id_enseignant_ext): self
    {
        $this->id_enseignant_ext = $id_enseignant_ext;

        return $this;
    }

    public function getIdClasseExt(): ?int
    {
        return $this->id_classe_ext;
    }

    public function setIdClasseExt(int $id_classe_ext): self
    {
        $this->id_classe_ext = $id_classe_ext;

        return $this;
    }
}
