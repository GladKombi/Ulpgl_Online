<?php
#Demarer la session
session_start();
try {
	$bdd = new PDO('mysql:dbname=bd_saint_croix; host=localhost', 'root', '');
} catch (Exception $e) {
	echo $e->getMessage();
}
