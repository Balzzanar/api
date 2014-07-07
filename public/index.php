<?php

/**
 * Very simple MVC structure
 */

$loader = new \Phalcon\Loader();

$loader->registerDirs(array('../apps/controllers/', '../apps/models/'));

$loader->register();

$di = new \Phalcon\DI();

//Registering a router
$di->set('router', 'Phalcon\Mvc\Router');

//Registering a dispatcher
$di->set('dispatcher', 'Phalcon\Mvc\Dispatcher');

//Registering a Http\Response
$di->set('response', 'Phalcon\Http\Response');

//Registering a Http\Request
$di->set('request', 'Phalcon\Http\Request');

//Registering the view component
$di->set('view', function(){
	$view = new \Phalcon\Mvc\View();
	$view->setViewsDir('../apps/views/');
	return $view;
});

/** Init the database connection */
$di->set('db', function(){
	return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
		"host" => "localhost:3306",
		"username" => "root",
		"password" => "",
		"dbname" => "hejsan"
	));
});

//Registering the Models-Metadata
$di->set('modelsMetadata', 'Phalcon\Mvc\Model\Metadata\Memory');

//Registering the Models Manager
$di->set('modelsManager', 'Phalcon\Mvc\Model\Manager');

try {
	$application = new \Phalcon\Mvc\Application();
	$application->setDI($di);
	echo $application->handle()->getContent();
}
catch(Phalcon\Exception $e){

    /** Code to make 404-response working properly. */
	echo $e->getMessage();
	        // remove view contents from buffer
        ob_clean();

        $errorCode = 500;
        $errorView = '../apps/errors/500_error.phtml';

        switch (true) {
            // 401 UNAUTHORIZED
            case $e->getCode() == 401:
                $errorCode = 401;
                $errorView = '../apps/errors/401_unathorized.phtml';
                break;

            // 403 FORBIDDEN
            case $e->getCode() == 403:
                $errorCode = 403;
                $errorView = '../apps/errors/403_forbidden.phtml';
                break;

            // 404 NOT FOUND
            case $e->getCode() == 404:
            case ($e instanceof Phalcon\Mvc\View\Exception):
            case ($e instanceof Phalcon\Mvc\Dispatcher\Exception):
                $errorCode = 404;
                $errorView = '../apps/errors/404_not_found.phtml';
                break;
        }

        // Get error view contents. Since we are including the view
        // file here you can use PHP and local vars inside the error view.
        ob_start();
        include_once $errorView;
        $contents = ob_get_contents();
        ob_end_clean();

        // send view to header
        $response = $di->getShared('response');
        $response->resetHeaders()
            ->setStatusCode($errorCode, null)
            ->setContent($contents)
            ->send();
}
