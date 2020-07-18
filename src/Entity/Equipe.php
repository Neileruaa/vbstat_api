<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipeRepository::class)
 * @ApiResource()
 */
class Equipe
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
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity=Entraineur::class, mappedBy="equipe")
     */
    private $entraineurs;

    public function __construct()
    {
        $this->entraineurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Entraineur[]
     */
    public function getEntraineurs(): Collection
    {
        return $this->entraineurs;
    }

    public function addEntraineur(Entraineur $entraineur): self
    {
        if (!$this->entraineurs->contains($entraineur)) {
            $this->entraineurs[] = $entraineur;
            $entraineur->addEquipe($this);
        }

        return $this;
    }

    public function removeEntraineur(Entraineur $entraineur): self
    {
        if ($this->entraineurs->contains($entraineur)) {
            $this->entraineurs->removeElement($entraineur);
            $entraineur->removeEquipe($this);
        }

        return $this;
    }
}
