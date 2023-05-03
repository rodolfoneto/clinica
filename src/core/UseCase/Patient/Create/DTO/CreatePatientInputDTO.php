<?php

namespace Core\UseCase\Patient\Create\DTO;

class CreatePatientInputDTO
{
    public function __construct(
        public string $name,
        public string $gender,
    ) {}
}
