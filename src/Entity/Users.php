<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=false)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=180, unique=false)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lignes", mappedBy="VisaResponsable")
     */
    private $ligne;

    public function __construct()
    {
        $this->chaines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @see UserInterface
     */
    public function getFirstname(): string
    {
        return (string) $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getLastname(): string
    {
        return (string) $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Chaines[]
     */
    public function getChaines(): Collection
    {
        return $this->chaines;
    }

    public function addChaine(Chaines $chaine): self
    {
        if (!$this->chaines->contains($chaine)) {
            $this->chaines[] = $chaine;
            $chaine->setVisaResponsable($this);
        }

        return $this;
    }

    public function removeChaine(Chaines $chaine): self
    {
        if ($this->chaines->contains($chaine)) {
            $this->chaines->removeElement($chaine);
            // set the owning side to null (unless already changed)
            if ($chaine->getVisaResponsable() === $this) {
                $chaine->setVisaResponsable(null);
            }
        }

        return $this;
    }
}
