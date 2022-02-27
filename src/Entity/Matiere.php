<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity=Enseignant::class, mappedBy="id_matiere_key")
     */
    private $enseignants;

    /**
     * @ORM\OneToMany(targetEntity=Enseignant::class, mappedBy="id_matiere")
     */
    private $id_matiere;

    public function __construct()
    {
        $this->enseignants = new ArrayCollection();
        $this->id_matiere = new ArrayCollection();
    }

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

    /**
     * @return Collection|Enseignant[]
     */
    public function getEnseignants(): Collection
    {
        return $this->enseignants;
    }

    public function addEnseignant(Enseignant $enseignant): self
    {
        if (!$this->enseignants->contains($enseignant)) {
            $this->enseignants[] = $enseignant;
            $enseignant->setIdMatiereKey($this);
        }

        return $this;
    }

    public function removeEnseignant(Enseignant $enseignant): self
    {
        if ($this->enseignants->removeElement($enseignant)) {
            // set the owning side to null (unless already changed)
            if ($enseignant->getIdMatiereKey() === $this) {
                $enseignant->setIdMatiereKey(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Enseignant[]
     */
    public function getIdMatiere(): Collection
    {
        return $this->id_matiere;
    }

    public function addIdMatiere(Enseignant $id_matiere): self
    {
        if (!$this->id_matiere->contains($id_matiere)) {
            $this->id_matiere[] = $id_matiere;
            $id_matiere->setIdMatiere($this);
        }

        return $this;
    }

    public function removeIdMatiere(Enseignant $id_matiere): self
    {
        if ($this->id_matiere->removeElement($id_matiere)) {
            // set the owning side to null (unless already changed)
            if ($id_matiere->getIdMatiere() === $this) {
                $id_matiere->setIdMatiere(null);
            }
        }

        return $this;
    }
}
