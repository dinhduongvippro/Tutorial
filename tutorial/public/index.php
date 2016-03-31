<?php
// phpinfo();exit;
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);
define('APP_PATH', realpath('..') . '/');
include __DIR__."/../apps/common/configs/var.php";
include __DIR__."/../apps/common/configs/module.php";
$config = require __DIR__ . "/../apps/common/configs/config.php";
try {
	/**
	 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
	 */
	$di = new \Phalcon\DI\FactoryDefault();
	/**
	 * Registering a router
	 */
	$di['router'] = function() {
		$router = new \Phalcon\Mvc\Router(true);

		///////////// FONTEND ///////////////
		$router->add('/:params', 							array('module' => 'frontend','controller' => 'index',	'action' => 'index',"params" => 1));
		$router->add('/:controller/:params', 				array('module' => 'frontend','controller' => 1,			'action' => 'index',"params" => 2));
		$router->add('/:controller/:action/:params', 		array('module' => 'frontend','controller' => 1,			'action' => 2,		"params" => 3));
		
		///////////// BACKEND ///////////////
		$router->add('/admin/:params', 						array('module' => 'backend','controller' => 'index',	'action' => 'index',"params" => 1));
		$router->add('/admin/:controller/:params', 			array('module' => 'backend','controller' => 1,			'action' => 'index',"params" => 2));
		$router->add('/admin/:controller/:action/:params', 	array('module' => 'backend','controller' => 1,			'action' => 2,		"params" => 3));
		
		$router->setDefaults(array('module' => 'frontend','controller' => 'index','action' => 'index'));
		return $router;
	};

	/**
	 * The URL component is used to generate all kind of urls in the application
	 */
	$di->set('url', function() {
		$url = new \Phalcon\Mvc\Url();
		$url->setBaseUri('/');
		return $url;
	});
	/**
	 * Start the session the first time some component request the session service
	 */
	$di->set('session', function() {
		$session = new \Phalcon\Session\Adapter\Files();
		$session->start();
		return $session;
	});
	// $di->set('crmcache', function () {
		// // Cache data for one day by default
		// $frontCache = new \Phalcon\Cache\Frontend\Data(array("lifetime" => LIFE_TIME));
		// // Memcached connection settings
		// $cache = new \Phalcon\Cache\Backend\Memcache(
				// $frontCache,
				// array(
					// "host" => "221.133.7.87",
					// "port" => "11211",
					// "prefix" => PREFIX_CACHE
				// )
		// );
		// return $cache;
	// });
	// $di->set('crmcacheap', function () {
		// // Cache data for one day by default
		// $frontCache = new \Phalcon\Cache\Frontend\Data(array("lifetime" => LIFE_TIME));
		// // Memcached connection settings
		// $cache = new \Phalcon\Cache\Backend\Memcache(
				// $frontCache,
				// array(
					// "host" => "221.133.7.87",
					// "port" => "11211",
					// "prefix" => 'crmcacheap'
				// )
		// );
		// return $cache;
	// });	
	$di-> set('db',function() use ($config) {
		return new Phalcon\Db\Adapter\Pdo\Mysql(array(
			"host" 		=> $config->db->host,
			"username"  => $config->db->username,
			"password"  => $config->db->password,
			"dbname" 	=> $config->db->name,
			'charset' 	=> $config->db->charset
		));
	});
	// $di-> set('crm',function() use ($config) {
		// return new Phalcon\Db\Adapter\Pdo\Mysql(array(
			// "host" 		=> $config->crm->host,
			// "username"  => $config->crm->username,
			// "password"  => $config->crm->password,
			// "dbname" 	=> $config->crm->name,
			// 'charset' 	=> $config->crm->charset
		// ));
	// });
	// $di-> set('ads',function() use ($config) {
		// return new Phalcon\Db\Adapter\Pdo\Mysql(array(
			// "host" 		=> $config->ads->host,
			// "username"  => $config->ads->username,
			// "password"  => $config->ads->password,
			// "dbname" 	=> $config->ads->name,
			// // 			'charset' 	=> $config->ads->charset
		// ));
	// });
	// $di-> set('auth3',function() use ($config) {
		// return new Phalcon\Db\Adapter\Pdo\Mysql(array(
			// "host" 		=> $config->auth3->host,
			// "username"  => $config->auth3->username,
			// "password"  => $config->auth3->password,
			// "dbname" 	=> $config->auth3->name,
			// // 			'charset' 	=> $config->auth3->charset
		// ));
	// });
	$di->set('collectionManager', function(){return new Phalcon\Mvc\Collection\Manager();}, true);
	// $di->set('bigdata', function () use ($config) {
		// if (!$config->bigdata->username OR !$config->bigdata->password) {
			// $mongo = new MongoClient('mongodb://'.$config->bigdata->host);
		// } else {
			// $mongo = new MongoClient("mongodb://" . $config->bigdata->username . ":" . $config->bigdata->password . "@" . $config->bigdata->host,array("db" => $config->bigdata->name));
		// }
		// return $mongo->selectDb($config->bigdata->name);
	// }, TRUE);

	// $di->set('bigdatatest', function () use ($config) {
		// if (!$config->bigdatatest->username OR !$config->bigdatatest->password) {
			// $mongo = new MongoClient('mongodb://'.$config->bigdatatest->host);
		// } else {
			// $mongo = new MongoClient("mongodb://" . $config->bigdatatest->username . ":" . $config->bigdatatest->password . "@" . $config->bigdatatest->host,array("db" => $config->bigdatatest->name));
		// }
		// return $mongo->selectDb($config->bigdatatest->name);
	// }, TRUE);
	/**
	 * Handle the request
	 */
	$application = new \Phalcon\Mvc\Application();
	$application->setDI($di);
	/**
	 * Register application modules
	 */
	$application->registerModules(array(
		'frontend' => array(
			'className' => 'Modules\Frontend\Module',
			'path' => '../apps/frontend/Module.php'
		),
		'backend' => array(
			'className' => 'Modules\Backend\Module',
			'path' => '../apps/backend/Module.php'
		)
	));
	
	echo $application->handle()->getContent();
} catch (Phalcon\Exception $e) {
	echo $e->getMessage();
} catch (PDOException $e){
	echo $e->getMessage();
}
