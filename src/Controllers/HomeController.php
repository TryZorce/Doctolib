<?php
class HomeController
{
    use Response;
    public function index()
    {
        $this->render('index');
    }

    public function pageNotFound()
    {
        echo '<p>Page introuvable</p>';
    }
}
