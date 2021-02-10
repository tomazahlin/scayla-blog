<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table("user_account")
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User extends AbstractEntity
{
    public const STATUS_DISABLED = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_PENDING = 2;

    /**
     * @ORM\Column(type="smallint", name="status", options={"default": 1})
     */
    protected int $status = self::STATUS_ACTIVE;

    /**
     * @ORM\Column(type="string", name="username", nullable=false, length=120, unique=true)
     */
    protected ?string $username = null;

    /**
     * @ORM\Column(type="string", name="password")
     */
    protected ?string $password = null;


    public function __construct()
    {
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }
}
