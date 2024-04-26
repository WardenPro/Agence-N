<?php

namespace App\Entity;

use App\Repository\ListeFraisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListeFraisRepository::class)]
class ListeFrais
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $equipement = null;

    #[ORM\Column(length: 255)]
    private ?string $missions = null;

    #[ORM\Column]
    private ?int $repas = null;

    #[ORM\Column(length: 255)]
    private ?string $divers = null;

    #[ORM\Column]
    private ?int $TVA = null;

    #[ORM\Column]
    private ?int $debut_km = null;

    #[ORM\Column]
    private ?int $fin_km = null;

    #[ORM\Column]
    private ?int $montant_total = null;

    #[ORM\Column(nullable: true)]
    private ?int $forfait_kilometrique = null;
    

    #[ORM\ManyToOne(inversedBy: 'NoteFrais')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Frais $frais = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getEquipement(): ?int
    {
        return $this->equipement;
    }

    public function setEquipement(int $equipement): static
    {
        $this->equipement = $equipement;

        return $this;
    }

    public function getMissions(): ?string
    {
        return $this->missions;
    }

    public function setMissions(string $missions): static
    {
        $this->missions = $missions;

        return $this;
    }

    public function getRepas(): ?int
    {
        return $this->repas;
    }

    public function setRepas(int $repas): static
    {
        $this->repas = $repas;

        return $this;
    }

    public function getDivers(): ?string
    {
        return $this->divers;
    }

    public function setDivers(string $divers): static
    {
        $this->divers = $divers;

        return $this;
    }

    public function getTVA(): ?int
    {
        return $this->TVA;
    }

    public function setTVA(int $TVA): static
    {
        $this->TVA = $TVA;

        return $this;
    }

    public function getDebutKm(): ?int
    {
        return $this->debut_km;
    }

    public function setDebutKm(int $debut_km): static
    {
        $this->debut_km = $debut_km;

        return $this;
    }

    public function getFinKm(): ?int
    {
        return $this->fin_km;
    }

    public function setFinKm(int $fin_km): static
    {
        $this->fin_km = $fin_km;

        return $this;
    }

    public function getMontantTotal(): ?int
    {
        return $this->montant_total;
    }

    public function setMontantTotal(int $montant_total): static
    {
        $this->montant_total = $montant_total;

        return $this;
    }

    public function getForfaitKilometrique(): ?int
    {
        return $this->forfait_kilometrique;
    }

    public function setForfaitKilometrique(int $forfait_kilometrique): static
    {
        $this->forfait_kilometrique = $forfait_kilometrique;

        return $this;
    }

    public function getFrais(): ?Frais
    {
        return $this->frais;
    }

    public function setFrais(?Frais $frais): static
    {
        $this->frais = $frais;

        return $this;
    }
}
