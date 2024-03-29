<?php

class Appointment
{
    private $id;
    private $date_and_time;
    private $doctor_id;
    private $user_id;

    public function __construct($id, $date_and_time, $doctor_id, $user_id)
    {
        $this->id = $id;
        $this->date_and_time = $date_and_time;
        $this->doctor_id = $doctor_id;
        $this->user_id = $user_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDateAndTime()
    {
        return $this->date_and_time;
    }

    public function getDoctorId()
    {
        return $this->doctor_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }
}
