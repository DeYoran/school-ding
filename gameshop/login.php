<?php
session_start();
require_once('api/engine/model/gebruiker.php');


	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

$_SESSION['loggedin'] = true;
require_once('api/bootstrap.php');
$user = $em->getRepository("Engine\Model\Gebruiker")->findBy(array('klantnr'=>3));
$_SESSION['kr-user'] = $user[0];
header("Location: http://gameshop.sygnal.nl/home");
die();