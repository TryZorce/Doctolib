<?php
class HomeController
{
    use Response;
    public function index()
    {$this->render('index');
        echo 'Page d\'accueil';
    }

    public function pageNotFound()
    {
        echo '<p>Page introuvable</p>';
    }
}
?>
