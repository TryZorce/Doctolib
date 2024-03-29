<?php

class AppointmentController
{
    use Response;

    private $appointmentRepository;

    public function __construct()
    {
        $this->appointmentRepository = new AppointmentRepository();
    }
    public function index()
    {
        $user_id = $_SESSION['email'];
        $appointmentRepository = new AppointmentRepository();
        $appointments = $appointmentRepository->getAppointmentsByUserEmail($user_id);
        $this->render('profile', ['appointments' => $appointments, 'appointmentRepository' => $appointmentRepository]);
    }
    
    

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $date_and_time = $_POST['date_and_time'];
            $doctor_id = $_POST['doctor_id'];
    
            $user_email = $_SESSION['email'];
    
            $user = new User();
    
            $user_data = $user->getUserByEmail($user_email);

            if ($user_data) {
                $user_id = $user_data['id'];
                $this->appointmentRepository->createAppointment($date_and_time, $doctor_id, $user_id);
    
                echo '<meta http-equiv="refresh" content="0;url=' . URL_APPOINTMENTS . '">';
            } else {
                echo "L'utilisateur n'existe pas dans la base de données.";
            }
        } else {
            $this->render('create_appointment');
        }
    }
    
    

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $date_and_time = $_POST['date_and_time'];
            $doctor_id = $_POST['doctor_id'];
            $user_id = $_SESSION['user_id'];
    
            $this->appointmentRepository->updateAppointment($id, $date_and_time, $doctor_id, $user_id);
    
            echo '<meta http-equiv="refresh" content="0;url=' . URL_APPOINTMENTS . '">';
        } else {
            $appointment = $this->appointmentRepository->getAppointmentById($id);
            $this->render('update_appointment', ['appointment' => $appointment]);
        }
    }
    
    

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $this->appointmentRepository->deleteAppointment($id);
            echo '<meta http-equiv="refresh" content="0;url=' . URL_APPOINTMENTS . '">';
        } else {
            $id = $_GET['id'];
            $appointment = $this->appointmentRepository->getAppointmentById($id);
            $this->render('delete_appointment', ['appointment' => $appointment]);
        }
    }

}
