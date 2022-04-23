<?php

namespace Claudio\LeaningAboutCleanArchitecture\Domain;

interface StudentRepositoryInterface
{
    /** @return Student[] */
    public function findAll(): array;
    public function add(Student $student): void;
    public function findByCpf(string $cpf): ?Student;
}
