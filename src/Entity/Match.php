<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MatchRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MatchRepository::class)
 * @ORM\Table(name="`match`")
 * @ApiResource()
 */
class Match
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("api:get")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Salle::class, inversedBy="matches")
     */
    private $salle;

    /**
     * @ORM\ManyToOne(targetEntity=Set::class, inversedBy="matchs")
     */
    private $sets;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $scoreA;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $scoreB;

    /**
     * @ORM\ManyToOne(targetEntity=Equipe::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipeA;

    /**
     * @ORM\ManyToOne(targetEntity=Equipe::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipeB;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

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

    public function getScoreA(): ?int
    {
        return $this->scoreA;
    }

    public function setScoreA(?int $scoreA): self
    {
        $this->scoreA = $scoreA;

        return $this;
    }

    public function getScoreB(): ?int
    {
        return $this->scoreB;
    }

    public function setScoreB(?int $scoreB): self
    {
        $this->scoreB = $scoreB;

        return $this;
    }

    public function getEquipeA(): ?Equipe
    {
        return $this->equipeA;
    }

    public function setEquipeA(?Equipe $equipeA): self
    {
        $this->equipeA = $equipeA;

        return $this;
    }

    public function getEquipeB(): ?Equipe
    {
        return $this->equipeB;
    }

    public function setEquipeB(?Equipe $equipeB): self
    {
        $this->equipeB = $equipeB;

        return $this;
    }
}
