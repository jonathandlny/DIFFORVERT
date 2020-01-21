<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LignesRepository")
 */
class Lignes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Chaines", inversedBy="lignes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chaineNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrPerson;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChaineNumber(): ?Chaines
    {
        return $this->chaineNumber;
    }

    public function setChaineNumber(?Chaines $chaineNumber): self
    {
        $this->chaineNumber = $chaineNumber;

        return $this;
    }

    public function getNbrPerson(): ?int
    {
        return $this->nbrPerson;
    }

    public function setNbrPerson(int $nbrPerson): self
    {
        $this->nbrPerson = $nbrPerson;

        return $this;
    }
}
