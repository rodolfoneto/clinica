<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodsMagicTrait;
use Core\Domain\Validation\DomainValidation;
use DateTime;
use Tests\Unit\Core\Domain\Exception\EntityValidationException;
use function PHPUnit\Framework\isNull;

class Patient
{
    use MethodsMagicTrait;

    public function __construct(
        protected string $name,
        protected string $gender,
        protected ?int $id = null,
        protected ?DateTime $createdAt = null
    ) {
        $this->createdAt = $this->createdAt ?? new DateTime();
        $this->validate();
    }

    private function validate(): void
    {
        DomainValidation::strMinLength(value: $this->name, minLength: 2);
        DomainValidation::strMaxLength(value: $this->name, maxLength: 255);
        DomainValidation::strMinLength(value: $this->gender, minLength: 1);
    }
}
