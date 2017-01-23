<?php
session_start();
require_once('vendor/autoload.php');
require_once('app/wedding.php');
require_once('generated-conf/config.php');


$app = new Application();
$app->setControllerPath(__DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'controllers');


$app->bootstrap('view', function(){
    $view = new View();
    $view->addViewPath(__DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'views');

    $view->addHelper("title", function($part = false){
        static $parts = [];
        static $delimiter = ' - ';

        return ($part === false) ? implode($delimiter, $parts) : $parts[] = $part;
    });

    $view->addHelper("js", function($part = false){
        static $parts = [];

        if($part === false) {
            $strArr = [];
            foreach($parts as $part) {
                $strArr[] = sprintf('<script type="text/javascript" src="%s"></script>', $part);
            }

            return implode("\n", $strArr);
        }

        return $parts[] = $part;
    });



    return $view;
});



$app->bootstrap('layout', function(){
    $layout = new Layout();
    $layout->addViewPath(__DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'layouts');

    return $layout;
});


$app->run();

\Wedding\Registry::clear();