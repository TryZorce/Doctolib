<?php
class Doctor
{
    private $id;
    private $name;
    private $gender;
    private $specialty;

    public function __construct($id, $name, $gender, $specialty)
    {
        $this->id = $id;
        $this->name = $name;
        $this->gender = $gender;
        $this->specialty = $specialty;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getSpecialty()
    {
        return $this->specialty;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function setSpecialty($specialty)
    {
        $this->specialty = $specialty;
    }
}
