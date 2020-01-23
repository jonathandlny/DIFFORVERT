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
     * @ORM\Column(type="integer")
     */
    private $nbrPerson;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $pickingDeco;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalP;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $client;

    /**
     * @ORM\Column(type="date")
     */
    private $enlevement;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $etiquette;

    /**
     * @ORM\Column(type="integer")
     */
    private $hauteurCarton;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreCarton;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreCartonPalettes;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalPalette;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrEtage;

    /**
     * @ORM\Column(type="integer")
     */
    private $etageChariot;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalChariot;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $detailAProduire;

    /**
     * @ORM\Column(type="float")
     */
    private $tempsTotalHeures;

    /**
     * @ORM\Column(type="float")
     */
    private $tempsPaletteRollsMinutes;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heureDebut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heureFin;

    /**
     * @ORM\Column(type="integer")
     */
    private $tempsRealise;

    /**
     * @ORM\Column(type="integer")
     */
    private $verifTemps;

    /**
     * @ORM\Column(type="integer")
     */
    private $pickingProduit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Chaines", inversedBy="lignes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chaines;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPickingDeco(): ?string
    {
        return $this->pickingDeco;
    }

    public function setPickingDeco(string $pickingDeco): self
    {
        $this->pickingDeco = $pickingDeco;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getTotalP(): ?int
    {
        return $this->totalP;
    }

    public function setTotalP(int $totalP): self
    {
        $this->totalP = $totalP;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(string $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getEnlevement(): ?\DateTimeInterface
    {
        return $this->enlevement;
    }

    public function setEnlevement(\DateTimeInterface $enlevement): self
    {
        $this->enlevement = $enlevement;

        return $this;
    }

    public function getEtiquette(): ?string
    {
        return $this->etiquette;
    }

    public function setEtiquette(string $etiquette): self
    {
        $this->etiquette = $etiquette;

        return $this;
    }

    public function getHauteurCarton(): ?int
    {
        return $this->hauteurCarton;
    }

    public function setHauteurCarton(int $hauteurCarton): self
    {
        $this->hauteurCarton = $hauteurCarton;

        return $this;
    }

    public function getNombreCarton(): ?int
    {
        return $this->nombreCarton;
    }

    public function setNombreCarton(int $nombreCarton): self
    {
        $this->nombreCarton = $nombreCarton;

        return $this;
    }

    public function getNombreCartonPalettes(): ?int
    {
        return $this->nombreCartonPalettes;
    }

    public function setNombreCartonPalettes(int $nombreCartonPalettes): self
    {
        $this->nombreCartonPalettes = $nombreCartonPalettes;

        return $this;
    }

    public function getTotalPalette(): ?int
    {
        return $this->totalPalette;
    }

    public function setTotalPalette(int $totalPalette): self
    {
        $this->totalPalette = $totalPalette;

        return $this;
    }

    public function getNbrEtage(): ?int
    {
        return $this->nbrEtage;
    }

    public function setNbrEtage(int $nbrEtage): self
    {
        $this->nbrEtage = $nbrEtage;

        return $this;
    }

    public function getEtageChariot(): ?int
    {
        return $this->etageChariot;
    }

    public function setEtageChariot(int $etageChariot): self
    {
        $this->etageChariot = $etageChariot;

        return $this;
    }

    public function getTotalChariot(): ?int
    {
        return $this->totalChariot;
    }

    public function setTotalChariot(int $totalChariot): self
    {
        $this->totalChariot = $totalChariot;

        return $this;
    }

    public function getDetailAProduire(): ?string
    {
        return $this->detailAProduire;
    }

    public function setDetailAProduire(string $detailAProduire): self
    {
        $this->detailAProduire = $detailAProduire;

        return $this;
    }

    public function getTempsTotalHeures(): ?float
    {
        return $this->tempsTotalHeures;
    }

    public function setTempsTotalHeures(float $tempsTotalHeures): self
    {
        $this->tempsTotalHeures = $tempsTotalHeures;

        return $this;
    }

    public function getTempsPaletteRollsMinutes(): ?float
    {
        return $this->tempsPaletteRollsMinutes;
    }

    public function setTempsPaletteRollsMinutes(float $tempsPaletteRollsMinutes): self
    {
        $this->tempsPaletteRollsMinutes = $tempsPaletteRollsMinutes;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heureFin;
    }

    public function setHeureFin(\DateTimeInterface $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    public function getTempsRealise(): ?int
    {
        return $this->tempsRealise;
    }

    public function setTempsRealise(int $tempsRealise): self
    {
        $this->tempsRealise = $tempsRealise;

        return $this;
    }

    public function getVerifTemps(): ?int
    {
        return $this->verifTemps;
    }

    public function setVerifTemps(int $verifTemps): self
    {
        $this->verifTemps = $verifTemps;

        return $this;
    }

    public function getPickingProduit(): ?int
    {
        return $this->pickingProduit;
    }

    public function setPickingProduit(int $pickingProduit): self
    {
        $this->pickingProduit = $pickingProduit;

        return $this;
    }

    public function getVisaResponsable(): ?Users
    {
        return $this->VisaResponsable;
    }

    public function setVisaResponsable(?Users $VisaResponsable): self
    {
        $this->VisaResponsable = $VisaResponsable;

        return $this;
    }

    public function getChaines(): ?Chaines
    {
        return $this->chaines;
    }

    public function setChaines(?Chaines $chaines): self
    {
        $this->chaines = $chaines;

        return $this;
    }
}
