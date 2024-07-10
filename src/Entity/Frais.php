<?php

namespace App\Entity;

use App\Repository\FraisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FraisRepository::class)]
class Frais
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $service = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $periode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\Column]
    #[Assert\GreaterThan(value: 0, message: 'Le montant doit être supérieur à 0.')]
    private ?int $total = null;

    #[ORM\ManyToOne(inversedBy: 'notefrais')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, ListeFrais>
     */
    #[ORM\OneToMany(targetEntity: ListeFrais::class, mappedBy: 'frais')]
    private Collection $NoteFrais;

    public function __construct()
    {
        $this->NoteFrais = new ArrayCollection();
        $this->status = 'En attente';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function getPeriode(): ?\DateTimeInterface
    {
        return $this->periode;
    }

    public function setPeriode(\DateTimeInterface $periode): static
    {
        $this->periode = $periode;

        return $this;
    }

    public function getStatus(): ?string
    {
        if ($this->status === null) {
            return 'En attente';
        }
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, ListeFrais>
     */
    public function getNoteFrais(): Collection
    {
        return $this->NoteFrais;
    }

    public function addNoteFrai(ListeFrais $noteFrai): static
    {
        if (!$this->NoteFrais->contains($noteFrai)) {
            $this->NoteFrais->add($noteFrai);
            $noteFrai->setFrais($this);
        }

        return $this;
    }

    public function removeNoteFrai(ListeFrais $noteFrai): static
    {
        if ($this->NoteFrais->removeElement($noteFrai)) {
            // set the owning side to null (unless already changed)
            if ($noteFrai->getFrais() === $this) {
                $noteFrai->setFrais(null);
            }
        }

        return $this;
    }
}
