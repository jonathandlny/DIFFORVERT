<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChainesRepository")
 */
class Chaines
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $chaineNumber;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lignes", mappedBy="chaineNumber")
     */
    private $lignes;

    public function __construct()
    {
        $this->lignes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChaineNumber(): ?int
    {
        return $this->chaineNumber;
    }

    public function setChaineNumber(int $chaineNumber): self
    {
        $this->chaineNumber = $chaineNumber;

        return $this;
    }

    /**
     * @return Collection|Lignes[]
     */
    public function getLignes(): Collection
    {
        return $this->lignes;
    }

    public function addLigne(Lignes $ligne): self
    {
        if (!$this->lignes->contains($ligne)) {
            $this->lignes[] = $ligne;
            $ligne->setChaineNumber($this);
        }

        return $this;
    }

    public function removeLigne(Lignes $ligne): self
    {
        if ($this->lignes->contains($ligne)) {
            $this->lignes->removeElement($ligne);
            // set the owning side to null (unless already changed)
            if ($ligne->getChaineNumber() === $this) {
                $ligne->setChaineNumber(null);
            }
        }

        return $this;
    }
}
