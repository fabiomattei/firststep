<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';
	
echo 'Hello World!!!';

$severWrapper = new Firststep\Common\Wrappers\ServerWrapper;
$sessionWrapper = new Firststep\Common\Wrappers\SessionWrapper;

$setup = new Firststep\Common\Setup\Setup();
$setup->setAppNameForPageTitle("Try app");
$setup->setPrivateTemplateFileName('application.php');
$setup->setPublicTemplateFileName('public.php');
$setup->setBasePath('http://localhost:18080/');
$setup->setPathToApp('/uglyduckling/');

$dbconnection = new Firststep\Common\Database\DBConnection( 
	'mysql:host=0.0.0.0:13306;dbname=',
	'firststep',
	'root',
	'password'
);

$request = new Firststep\Common\Request\Request();
$request->setServerRequestURI( $severWrapper->getRequestURI() );

$router = new Firststep\Common\Router\Router( $setup->getBasePath() );

$controller = $router->getController( $request->getAction() );

if ( $sessionWrapper->isUserLoggedIn() ) {
	// settings for logged in user
	$controller->makeAllPresets(
		$router,
    	$setup, 
    	$request,
		$severWrapper,
		$sessionWrapper,
		new Firststep\Common\SecurityCheckers\PrivateSecurityChecker(),
		$dbconnection,
    	new Firststep\Common\Redirectors\FakeRedirector(), 
    	new Firststep\Common\Loggers\EchoLogger(),
    	new Firststep\Common\Blocks\BaseMessages()
	);
} else {
	// settings for user that has not logged in the system
	$controller->makeAllPresets(
		$router,
    	$setup, 
    	$request,
		$severWrapper,
		$sessionWrapper,
		new Firststep\Common\SecurityCheckers\PublicSecurityChecker(),
		$dbconnection,
    	new Firststep\Common\Redirectors\FakeRedirector(), 
    	new Firststep\Common\Loggers\EchoLogger(),
    	new Firststep\Common\Blocks\BaseMessages()
	);
}

$controller->setParameters( $request->getParameters() );
// $controller->setRequest( $request );
// $controller->setControllerPath( OFFICE, CHAPTER, CONTROLLER );
$controller->showPage();

$sessionWrapper->endOfRound();

echo 'Controller loaded!!!';
