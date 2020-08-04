<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PointRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PointRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"point:read"}},
 *     denormalizationContext={"groups"={"point:write"}}
 * )
 */
class Point
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"point:read", "point:write", "set:read", "set:write"})
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Set::class, inversedBy="points")
     */
    private $sets;

    /**
     * @ORM\ManyToOne(targetEntity=Joueur::class, inversedBy="points")
     * @Groups({"point:read", "point:write", "set:read", "set:write"})
     */
    private $joueur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSets(): ?Set
    {
        return $this->sets;
    }

    public function setSets(?Set $sets): self
    {
        $this->sets = $sets;

        return $this;
    }

    public function getJoueur(): ?Joueur
    {
        return $this->joueur;
    }

    public function setJoueur(?Joueur $joueur): self
    {
        $this->joueur = $joueur;

        return $this;
    }
}
