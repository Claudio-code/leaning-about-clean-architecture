<?php

namespace Claudio\LeaningAboutCleanArchitecture\Infra\Persistence\Repository;

use Claudio\LeaningAboutCleanArchitecture\Core\Factory\StudentFactory;
use Claudio\LeaningAboutCleanArchitecture\Domain\ObjectValue\Phone;
use Claudio\LeaningAboutCleanArchitecture\Domain\Student;
use Claudio\LeaningAboutCleanArchitecture\Domain\StudentRepositoryInterface;
use PDO;

class StudentRepository implements StudentRepositoryInterface
{
    public function __construct(private readonly PDO $connection)
    {
    }

    public function findAll(): array
    {
        $sql = '
            SELECT 
                cpf, name, email, ddd, number
            FROM students
            LEFT JOIN phones
                ON students.cpf = phones.cpf;';
        $statement = $this->connection->query($sql);
        $statement->execute();
        $queryResult = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $this->mapperStudents($queryResult);
    }

    public function add(Student $student): void
    {
        $sql = 'INSERT INTO students VALUES (:cpf, :name, :email)';
        $statement = $this->connection->prepare($sql);
        $statement->bindValue('cpf', $student->cpf);
        $statement->bindValue('name', $student->name);
        $statement->bindValue('email', $student->email);
        $statement->execute();

        $student->phoneCollection->forAll(function (Phone $phone) use ($student) {
            $sql = 'INSERT INTO phones VALUES (:cpf, :phone)';
            $statement = $this->connection->prepare($sql);
            $statement->bindValue('cpf', $student->cpf);
            $statement->bindValue('phone', $phone->toString());
            $statement->execute();
        });
    }

    public function findByCpf(string $cpf): ?Student
    {
        $sql = '
            SELECT 
                cpf, name, email, ddd, number
            FROM students
            LEFT JOIN phones
                ON students.cpf = phones.cpf
            WHERE students.cpf = ?;
        ';
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(1, $cpf);
        $statement->execute();
        $queryResult = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $this->mapperStudent(reset($queryResult));
    }

    private function mapperStudents(array $students): array
    {
        $studentCollection = [];
        foreach ($students as $student) {
            $cpfValue = $student['cpf'];
            if (array_key_exists(key: $cpfValue, array: $studentCollection)) {
                continue;
            }
            $studentCollection[$cpfValue] = $this->mapperStudent($student);
        }
        return $studentCollection;
    }

    private function mapperStudent(array $student): Student
    {
        $studentDomain = (new StudentFactory())
            ->make(...$student)
            ->student();
        $phones = array_filter($student, fn (array $row): bool => $row['ddd'] != null && $row['number'] != null);
        foreach ($phones as $phone) {
            $phone = new Phone(...$phone);
            $studentDomain->phoneCollection->add($phone);
        }

        return $studentDomain;
    }
}
