<?php

class LogoutController
{use Response;
    public function logout()
    {
        session_destroy();
        $this->render('logout');
    }
}
