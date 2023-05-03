<?php

namespace Core\UseCase\Patient\Create;

use Core\Domain\Entity\Patient;
use Core\Domain\Repository\PatientRepositoryInterface;
use Core\UseCase\Patient\Create\DTO\{
    CreatePatientOutputDTO,
    CreatePatientInputDTO,
};

class CreatePatientUseCase
{
    public function __construct(
        protected PatientRepositoryInterface $repository
    ) {}

    public function execute(CreatePatientInputDTO $input): CreatePatientOutputDTO
    {
        $patientInput = new Patient(
            name: $input->name,
            gender: $input->gender
        );
        $patient = $this->repository->insert($patientInput);

        return new CreatePatientOutputDTO(
            id: $patient->id,
            name: $patient->name,
            gender: $patient->gender,
            created_at: $patient->createdAt(),
        );
    }
}
