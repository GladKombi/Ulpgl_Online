<?php
#Demarer la session
session_start();
try {
	$connexion = new PDO('mysql:dbname=bd_saint_croix; host=localhost', 'root', '');
} catch (Exception $e) {
	echo $e->getMessage();
}
