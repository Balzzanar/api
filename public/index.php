<?php

error_reporting(E_ALL);

try {

	/**
	 * Read the configuration
	 */
	$config = include(__DIR__."/../app/config/config.php");

	$loader = new \Phalcon\Loader();

	/**
	 * We're a registering a set of directories taken from the configuration file
	 */
	$loader->registerDirs(
		array(
			$config->application->controllersDir,
			$config->application->modelsDir
		)
	)->register();

	/**
	 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
	 */
	$di = new \Phalcon\DI\FactoryDefault();

	/**
	 * Include the application routes
	 */
	$di->set('router', function(){
		return include(__DIR__."/../app/config/routes.php");
	});

	/**
	 * The URL component is used to generate all kind of urls in the application
	 */
	$di->set('url', function() use ($config) {
		$url = new \Phalcon\Mvc\Url();
		$url->setBaseUri($config->application->baseUri);
		return $url;
	});

	/**
	 * Setting up the view component
	 */
	$di->set('view', function() use ($config) {
		$view = new \Phalcon\Mvc\View();
		$view->setViewsDir($config->application->viewsDir);
		return $view;
	});

	/**
	 * Database connection is created based in the parameters defined in the configuration file
	 */
	/*
	$di->set('db', function() use ($config) {
		return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
			"host" => $config->database->host,
			"username" => $config->database->username,
			"password" => $config->database->password,
			"dbname" => $config->database->name
		));
	});
	*/
	/** Init the database connection */
	$di->set('db', function(){
	   return new \Phalcon\Db\Adapter\Pdo\Sqlite(array(  // <- return
	      "dbname" => '../app/data/dansi.db'
	   ));
	});


	/**
	 * Register the flash service with custom CSS classes
	 */
	$di->set('flash', function(){
		return new Phalcon\Flash\Direct(array(
			'error' => 'alert alert-error',
			'success' => 'alert alert-success',
			'notice' => 'alert alert-info',
		));
	});

	/**
	 * Register the flash service with custom CSS classes
	 */
	$di->set('flashsess', function(){
		return new Phalcon\Flash\Session(array(
			'error' => 'alert alert-error',
			'success' => 'alert alert-success',
			'notice' => 'alert alert-info',
		));
	});

	/**
	 * Start the session the first time some component request the session service
	 */
	$di->set('session', function() {
		$session = new \Phalcon\Session\Adapter\Files();
		$session->start();
		return $session;
	});

	/**
	 * Handle the request
	 */
	$application = new \Phalcon\Mvc\Application();
	$application->setDI($di);
	echo $application->handle()->getContent();

} catch (Phalcon\Exception $e) {
	 /** Code to make 404-response working properly. */
	echo $e->getMessage(); die; // <-  MAKE SURE TO HAVE 'DIE' HERE, ELSE NO ERROR MSG! =(

	        // remove view contents from buffer
        ob_clean();

        $errorCode = 500;
        $errorView = '../app/errors/500_error.phtml';

        switch (true) {
            // 401 UNAUTHORIZED
            case $e->getCode() == 401:
                $errorCode = 401;
                $errorView = '../app/errors/401_unathorized.phtml';
                break;

            // 403 FORBIDDEN
            case $e->getCode() == 403:
                $errorCode = 403;
                $errorView = '../app/errors/403_forbidden.phtml';
                break;

            // 404 NOT FOUND
            case $e->getCode() == 404:
            case ($e instanceof Phalcon\Mvc\View\Exception):
            case ($e instanceof Phalcon\Mvc\Dispatcher\Exception):
                $errorCode = 404;
                $errorView = '../app/errors/404_not_found.phtml';
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


} catch (PDOException $e){
	echo $e->getMessage();
}
