    <?php

    $homeController = new HomeController();
    $profileController = new ProfileController();
    $appointmentController = new AppointmentController();

    $requestUri = $_SERVER['REQUEST_URI'];
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    switch ($requestUri) {
        case URL_HOMEPAGE:
            $homeController->index();
            break;
        case URL_REGISTER:
            $profileController->register_index();
            break;
        case URL_REGISTER . '/traitement':
            $profileController->create();
            break;
        case URL_LOGIN:
            $profileController->login_index();
            break;
        case URL_LOGIN . '/traitement':
            $profileController->login();
            break;
        case URL_LOGOUT:
            $profileController->logout();
            break;
        case URL_PROFILE:
            $profileController->index();
            break;
        case URL_PROFILE . '/update':
            $profileController->update();
            break;
        case URL_DELETE_ACCOUNT:
            $profileController->delete_index();
            break;
        case URL_DELETE_ACCOUNT . '/traitement':
            $profileController->destroy();
            break;
        case URL_APPOINTMENTS:
            $appointmentController->index();
            break;
        case URL_CREATE_APPOINTMENTS:
            $appointmentController->create();
            break;
        case URL_DELETE_APPOINTMENTS:
            $appointmentController->delete();
            break;
        case URL_UPDATE_APPOINTMENTS . '/([0-9]+)':
            $appointmentController->update($_GET[1]);
            break;

        default:
            $homeController->pageNotFound();
    }
