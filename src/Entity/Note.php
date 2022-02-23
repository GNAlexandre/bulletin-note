<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NoteRepository::class)
 */
class Note
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
    private $id_matiere_ext;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_eleve_ext;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="date")
     */
    private $date_controle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMatiereExt(): ?int
    {
        return $this->id_matiere_ext;
    }

    public function setIdMatiereExt(int $id_matiere_ext): self
    {
        $this->id_matiere_ext = $id_matiere_ext;

        return $this;
    }

    public function getIdEleveExt(): ?int
    {
        return $this->id_eleve_ext;
    }

    public function setIdEleveExt(int $id_eleve_ext): self
    {
        $this->id_eleve_ext = $id_eleve_ext;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getDateControle(): ?\DateTimeInterface
    {
        return $this->date_controle;
    }

    public function setDateControle(\DateTimeInterface $date_controle): self
    {
        $this->date_controle = $date_controle;

        return $this;
    }
}
