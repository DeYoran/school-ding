<?php
session_start();
unset($_SESSION['loggedin']);
header("Location: http://gameshop.sygnal.nl/home");
die();