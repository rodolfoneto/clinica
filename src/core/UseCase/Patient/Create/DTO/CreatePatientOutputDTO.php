<?php

namespace Core\UseCase\Patient\Create\DTO;

class CreatePatientOutputDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public string $gender,
        public string $created_at,
    ) {}
}
