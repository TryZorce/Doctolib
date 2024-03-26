<?php

function classLoader($className)
{
    $folderPathClasses = __DIR__ . '/Classes/';
    $folderPathModels = __DIR__ . '/Models/';
    $folderPathRepositories = __DIR__ . '/Repositories/';
    $folderPathControllers = __DIR__ . '/Controllers/';
    $folderPathViews = __DIR__ . '/Views/';
    $folderPathService = __DIR__ . '/Service/';

    $filePathClass = $folderPathClasses . $className . '.php';
    $filePathModel = $folderPathModels . $className . '.php';
    $filePathRepository = $folderPathRepositories . $className . '.php';
    $filePathController = $folderPathControllers . $className . '.php';
    $filePathView = $folderPathViews . $className . '.php';
    $filePathService = $folderPathService . $className . '.php';

    if (file_exists($filePathClass)) {
        require $filePathClass;
    } elseif (file_exists($filePathModel)) {
        require $filePathModel;
    } elseif (file_exists($filePathRepository)) {
        require $filePathRepository;
    } elseif (file_exists($filePathController)) {
        require $filePathController;
    } elseif (file_exists($filePathView)) {
        require $filePathView;
    }elseif (file_exists($filePathService)) {
        require $filePathService;
    }
}

spl_autoload_register('classLoader');

session_start();

$db = new Db();

require_once __DIR__ . "/router.php";


require_once __DIR__ . '/Service/Response.php';
