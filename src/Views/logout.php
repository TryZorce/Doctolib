<?php

include_once __DIR__ . "/../Components/header.php";
include_once __DIR__ . "/../Components/footer.php";
session_destroy();
echo '<meta http-equiv="refresh" content="0;url=' . URL_LOGIN . '">';




?>





