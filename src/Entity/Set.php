<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SetRepository::class)
 * @ORM\Table(name="`set`")
 * @ApiResource(
 *     normalizationContext={"groups"={"set:read"}},
 *     denormalizationContext={"groups"={"set:write"}}
 * )
 */
class Set
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"set:read"})
     */
    private $numero;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"set:read", "set:write"})
     */
    private $scoreA;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"set:read", "set:write"})
     */
    private $scoreB;

    /**
     * @ORM\OneToMany(targetEntity=Point::class, mappedBy="sets", cascade={"persist"})
     * @Groups({"set:read", "set:write"})
     */
    private $points;

    /**
     * @ORM\ManyToOne(targetEntity=Match::class, inversedBy="sets")
     * @Groups({"set:write"})
     */
    private $matchs;

    public function __construct()
    {
        $this->points = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getScoreA(): ?int
    {
        return $this->scoreA;
    }

    public function setScoreA(int $scoreA): self
    {
        $this->scoreA = $scoreA;

        return $this;
    }

    public function getScoreB(): ?int
    {
        return $this->scoreB;
    }

    public function setScoreB(int $scoreB): self
    {
        $this->scoreB = $scoreB;

        return $this;
    }

    /**
     * @return Collection|Point[]
     */
    public function getPoints(): Collection
    {
        return $this->points;
    }

    public function addPoint(Point $point): self
    {
        if (!$this->points->contains($point)) {
            $this->points[] = $point;
            $point->setSets($this);
        }

        return $this;
    }

    public function removePoint(Point $point): self
    {
        if ($this->points->contains($point)) {
            $this->points->removeElement($point);
            // set the owning side to null (unless already changed)
            if ($point->getSets() === $this) {
                $point->setSets(null);
            }
        }

        return $this;
    }

    public function getMatchs(): ?Match
    {
        return $this->matchs;
    }

    public function setMatchs(?Match $matchs): self
    {
        $this->matchs = $matchs;

        return $this;
    }
}
