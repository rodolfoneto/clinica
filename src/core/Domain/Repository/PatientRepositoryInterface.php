<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Patient;

interface PatientRepositoryInterface
{
    public function insert(Patient $entity): Patient;
    public function update(Patient $entity): Patient;
    public function delete(string $uuid): bool;

    public function findById(int $id): Patient;
    public function findAll(string $filter = '', $order = 'DESC'): array;
    public function paginate(
        string $filter = '',
               $order = 'DESC',
               $page = '1',
               $totalPerPage = 15): PaginationInterface;
}
