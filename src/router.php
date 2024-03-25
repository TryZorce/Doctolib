<?php

$homeController = new HomeController();
$patientController = new PatientController();
$registerController = new RegisterController();
$loginController = new LoginController();
$logoutController = new LogoutController();
$profileController = new ProfileController();
$deleteAccountController = new DeleteAccountController();

$requestUri = $_SERVER['REQUEST_URI'];

switch ($requestUri) {
    case URL_HOMEPAGE:
        $homeController->index();
        break;
    case URL_PATIENT:
        $patientController->index();
        break;
    case URL_REGISTER:
        $registerController->index();
        break;
    case URL_LOGIN:
        $loginController->index();
        break;
    case URL_LOGOUT:
        $logoutController->logout();
        break;
    case URL_PROFILE:
        $profileController->index();
        break;
    case URL_DELETE_ACCOUNT:
        $deleteAccountController->index();
        break;
    default:
        $homeController->pageNotFound();
}
