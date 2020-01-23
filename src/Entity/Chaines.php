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
    private $chaine_number;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lignes", mappedBy="chaines")
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
        return $this->chaine_number;
    }

    public function setChaineNumber(int $chaine_number): self
    {
        $this->chaine_number = $chaine_number;

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
            $ligne->setChaines($this);
        }

        return $this;
    }

    public function removeLigne(Lignes $ligne): self
    {
        if ($this->lignes->contains($ligne)) {
            $this->lignes->removeElement($ligne);
            // set the owning side to null (unless already changed)
            if ($ligne->getChaines() === $this) {
                $ligne->setChaines(null);
            }
        }

        return $this;
    }
}
