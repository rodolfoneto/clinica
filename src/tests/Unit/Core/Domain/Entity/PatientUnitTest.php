<?php

namespace Tests\Unit\Core\Domain\Entity;

use Core\Domain\Entity\Patient;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

class PatientUnitTest extends TestCase
{

    public function test_create_instance_with_invalid_name(): void
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage("The value must be greater than 2 characters");
        new Patient(
            name: "",
            gender: "M",
        );
    }

    public function test_create_instance_with_invalid_gender(): void
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage("The value must be greater than 1 characters");
        new Patient(
            name: "Patient 001",
            gender: "",
        );
    }

    public function test_create_instance(): void
    {
        $entity = new Patient(
            name: "Patient 01",
            gender: "M",
        );
        $this->assertInstanceOf(Patient::class, $entity);
    }
}
