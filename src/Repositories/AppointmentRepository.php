<?php

class AppointmentRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function createAppointment($date_and_time, $doctor_id, $user_id)
    {

        $query = "INSERT INTO appointments (date_and_time, doctor_id, user_id) VALUES (:date_and_time, :doctor_id, :user_id)";
        $stmt = $this->db->getDb()->prepare($query);
        $stmt->bindParam(':date_and_time', $date_and_time);
        $stmt->bindParam(':doctor_id', $doctor_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }

    public function getAppointmentById($id)
    {
        $query = "SELECT * FROM appointments WHERE id = :id";
        $stmt = $this->db->getDb()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Appointment($result['id'], $result['date_and_time'], $result['doctor_id'], $result['user_id']);
    }


    public function getAllAppointments()
    {
        $query = "SELECT * FROM appointments";
        $stmt = $this->db->getDb()->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $appointments = [];
        foreach ($results as $result) {
            $appointments[] = new Appointment($result['id'], $result['date_and_time'], $result['doctor_id'], $result['user_id']);
        }
        return $appointments;
    }

    public function updateAppointment($id, $date_and_time, $doctor_id, $user_id)
    {
        $query = "UPDATE appointments SET date_and_time = :date_and_time, doctor_id = :doctor_id, user_id = :user_id WHERE id = :id";
        $stmt = $this->db->getDb()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':date_and_time', $date_and_time);
        $stmt->bindParam(':doctor_id', $doctor_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }

    public function deleteAppointment($id)
    {
        $query = "DELETE FROM appointments WHERE id = :id";
        $stmt = $this->db->getDb()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getAppointmentsByUserEmail($email)
    {
        $query = "SELECT * FROM appointments WHERE user_id = (SELECT id FROM users WHERE email = :email)";
        $stmt = $this->db->getDb()->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $appointments = [];
        foreach ($results as $result) {
            $appointments[] = new Appointment($result['id'], $result['date_and_time'], $result['doctor_id'], $result['user_id']);
        }
        return $appointments;
    }
    public function getDoctorNameById($doctor_id)
    {
        
        $query = "SELECT name FROM doctors WHERE id = :doctor_id";
        $stmt = $this->db->getDb()->prepare($query);
        $stmt->bindParam(':doctor_id', $doctor_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['name'];
    }
}
