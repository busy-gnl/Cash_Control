<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Earnings::class)]
    private Collection $earnings;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: MonthlyExpenses::class)]
    private Collection $monthlyExpenses;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: OccasionalSpendings::class)]
    private Collection $occasionalSpendings;

    public function __construct()
    {
        $this->earnings = new ArrayCollection();
        $this->monthlyExpenses = new ArrayCollection();
        $this->occasionalSpendings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
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
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection<int, Earnings>
     */
    public function getEarnings(): Collection
    {
        return $this->earnings;
    }

    public function addEarning(Earnings $earning): self
    {
        if (!$this->earnings->contains($earning)) {
            $this->earnings->add($earning);
            $earning->setUser($this);
        }

        return $this;
    }

    public function removeEarning(Earnings $earning): self
    {
        if ($this->earnings->removeElement($earning)) {
            // set the owning side to null (unless already changed)
            if ($earning->getUser() === $this) {
                $earning->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MonthlyExpenses>
     */
    public function getMonthlyExpenses(): Collection
    {
        return $this->monthlyExpenses;
    }

    public function addMonthlyExpense(MonthlyExpenses $monthlyExpense): self
    {
        if (!$this->monthlyExpenses->contains($monthlyExpense)) {
            $this->monthlyExpenses->add($monthlyExpense);
            $monthlyExpense->setUser($this);
        }

        return $this;
    }

    public function removeMonthlyExpense(MonthlyExpenses $monthlyExpense): self
    {
        if ($this->monthlyExpenses->removeElement($monthlyExpense)) {
            // set the owning side to null (unless already changed)
            if ($monthlyExpense->getUser() === $this) {
                $monthlyExpense->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OccasionalSpendings>
     */
    public function getOccasionalSpendings(): Collection
    {
        return $this->occasionalSpendings;
    }

    public function addOccasionalSpending(OccasionalSpendings $occasionalSpending): self
    {
        if (!$this->occasionalSpendings->contains($occasionalSpending)) {
            $this->occasionalSpendings->add($occasionalSpending);
            $occasionalSpending->setUser($this);
        }

        return $this;
    }

    public function removeOccasionalSpending(OccasionalSpendings $occasionalSpending): self
    {
        if ($this->occasionalSpendings->removeElement($occasionalSpending)) {
            // set the owning side to null (unless already changed)
            if ($occasionalSpending->getUser() === $this) {
                $occasionalSpending->setUser(null);
            }
        }

        return $this;
    }
}
