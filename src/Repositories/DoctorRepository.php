<?php
class DoctorRepository
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllDoctors()
    {
        $stmt = $this->pdo->query('SELECT * FROM doctors');
        $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($doctors as $doctor) {
            $objects[] = new Doctor($doctor['id'], $doctor['name'], $doctor['gender'], $doctor['specialty']);
        }
        return $objects;
    }
    

    public function getDoctorById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM doctors WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Doctor');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function addDoctor(Doctor $doctor)
    {
        $stmt = $this->pdo->prepare('INSERT INTO doctors (name, gender, specialty) VALUES (:name, :gender, :specialty)');
        $stmt->bindParam(':name', $doctor->getName());
        $stmt->bindParam(':gender', $doctor->getGender());
        $stmt->bindParam(':specialty', $doctor->getSpecialty());
        $stmt->execute();
    }

    public function updateDoctor(Doctor $doctor)
    {
        $stmt = $this->pdo->prepare('UPDATE doctors SET name = :name, gender = :gender, specialty = :specialty WHERE id = :id');
        $stmt->bindParam(':id', $doctor->getId());
        $stmt->bindParam(':name', $doctor->getName());
        $stmt->bindParam(':gender', $doctor->getGender());
        $stmt->bindParam(':specialty', $doctor->getSpecialty());
        $stmt->execute();
    }

    public function deleteDoctor($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM doctors WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
