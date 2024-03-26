<?php

class PatientController
{
    use Response;
    public function index()
    {
        
        $this->render('patient');
    }
}
