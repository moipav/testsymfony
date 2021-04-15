<?php

namespace App\Entity;

use App\Repository\TeamPlayerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamPlayerRepository::class)
 */
class TeamPlayer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public string $name;

    /**
     * @ORM\ManyToOne(targetEntity="Sport", cascade={"persist"})
     * @ORM\JoinColumn(name="sport_id", referencedColumnName="id")
     */
    public Sport $sport;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Sport
     */
    public function getSport(): Sport
    {
        return $this->sport;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
       return $this->name;
    }
}
