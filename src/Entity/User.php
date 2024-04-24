<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    /**
     * @var Collection<int, Conge>
     */
    #[ORM\OneToMany(targetEntity: Conge::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $DemandesConge;

    /**
     * @var Collection<int, Frais>
     */
    #[ORM\OneToMany(targetEntity: Frais::class, mappedBy: 'user')]
    private Collection $notefrais;

    public function __construct()
    {
        $this->DemandesConge = new ArrayCollection();
        $this->notefrais = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, Conge>
     */
    public function getDemandesConge(): Collection
    {
        return $this->DemandesConge;
    }

    public function addDemandesConge(Conge $demandesConge): static
    {
        if (!$this->DemandesConge->contains($demandesConge)) {
            $this->DemandesConge->add($demandesConge);
            $demandesConge->setUser($this);
        }

        return $this;
    }

    public function removeDemandesConge(Conge $demandesConge): static
    {
        if ($this->DemandesConge->removeElement($demandesConge)) {
            // set the owning side to null (unless already changed)
            if ($demandesConge->getUser() === $this) {
                $demandesConge->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Frais>
     */
    public function getNotefrais(): Collection
    {
        return $this->notefrais;
    }

    public function addNotefrai(Frais $notefrai): static
    {
        if (!$this->notefrais->contains($notefrai)) {
            $this->notefrais->add($notefrai);
            $notefrai->setUser($this);
        }

        return $this;
    }

    public function removeNotefrai(Frais $notefrai): static
    {
        if ($this->notefrais->removeElement($notefrai)) {
            // set the owning side to null (unless already changed)
            if ($notefrai->getUser() === $this) {
                $notefrai->setUser(null);
            }
        }

        return $this;
    }
}
