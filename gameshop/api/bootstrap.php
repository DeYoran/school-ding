<?php

/*  
*   Bootstrap.php wordt gebruikt om de processen te starten die het systeem nodig heeft om te kunne draaien,
*   dit houdt bijvoorbeeld in sessies, de databaseconnectie etc.
*/

session_start();

global $em, $curUser;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Engine\Model\Gebruiker;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);
// or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
$conn = array(
    'driver'   => 'pdo_mysql',
    'host'     => '127.0.0.1',
    'dbname'   => 'game',
    'user'     => 'root',
    'password' => ''
);


// obtaining the entity manager
$em = EntityManager::create($conn, $config);

if(isset($_SESSION['uid'])){
    $curUser = $em->find('Gebruiker',intval($_SESSION['uid']));
}
else{
    $curUser = false;
}
