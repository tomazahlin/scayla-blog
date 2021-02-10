<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @Assert\NotNull(message="error.field.not_blank", groups={"Update"})
     * @Assert\PositiveOrZero(message="error.position_invalid", groups={"Update"})
     */
    protected ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
