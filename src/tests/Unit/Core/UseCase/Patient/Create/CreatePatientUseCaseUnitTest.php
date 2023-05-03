<?php

namespace Tests\Unit\Core\UseCase\Patient\Create;

use Core\Domain\Entity\Patient;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Repository\PatientRepositoryInterface;
use Core\UseCase\Patient\Create\CreatePatientUseCase;
use Core\UseCase\Patient\Create\DTO\{
    CreatePatientOutputDTO,
    CreatePatientInputDTO,
};
use PHPUnit\Framework\TestCase;
use Mockery;
use DateTime;

class CreatePatientUseCaseUnitTest extends TestCase
{
    protected function setUp(): void
    {
//        $this->repository = $this->createMockRepository();
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_create_patient_with_valid_data(): void
    {
        $repository = $this->createMockRepository(name: "Name of Patient", gender: "F");
        $input = $this->createMockInputDTO(name: "Name of Patient", gender: "F");

        $useCase = new CreatePatientUseCase(repository: $repository);
        $output = $useCase->execute($input);

        $this->assertInstanceOf(CreatePatientOutputDTO::class, $output);
        $this->assertEquals($input->name, $output->name);
        $this->assertEquals($input->gender, $output->gender);
        $this->assertEquals('2023-10-10 10:10:10', $output->created_at);
        $this->assertTrue(true);
    }

    public function test_create_patient_with_invalid_name(): void
    {
        $repository = $this->createMockRepository(name: "Name", gender: "F", timesInsertCalls: 0);
        $input = $this->createMockInputDTO(name: "N", gender: "F");

        $useCase = new CreatePatientUseCase(repository: $repository);
        $this->expectException(EntityValidationException::class);
        $output = $useCase->execute($input);

        $this->assertInstanceOf(CreatePatientOutputDTO::class, $output);
        $this->assertEquals($input->name, $output->name);
        $this->assertEquals($input->gender, $output->gender);
        $this->assertEquals('2023-10-10 10:10:10', $output->created_at);
        $this->assertTrue(true);
    }

    protected function createMockRepository(string $name, string $gender, $timesInsertCalls = 1)
    {
        $entity = $this->createMockEntity(name: $name, gender: $gender);
        $repository = Mockery::mock(PatientRepositoryInterface::class);
        $repository->shouldReceive('insert')
            ->times($timesInsertCalls)
            ->andReturn($entity);
        return $repository;
    }

    protected function createMockEntity(string $name, string $gender): Patient
    {
        $entity = Mockery::mock(Patient::class, [
            $name,
            $gender,
            101,
            new DateTime(),
        ]);
        $entity->shouldReceive('createdAt')->andReturn('2023-10-10 10:10:10');
        return $entity;
    }

    protected function createMockInputDTO(string $name, string $gender)
    {
        return Mockery::mock(CreatePatientInputDTO::class, [
            $name,
            $gender
        ]);
    }
}
