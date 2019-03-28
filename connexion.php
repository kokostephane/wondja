<?php
error_reporting(E_ALL|E_NOTICE);
$param_host="localhost";
$param_nm_bd="aliment";
$param_utilisateur="root";
$param_mot_passe="";
try
{
	$bdd= new PDO("mysql:host=$param_host;dbname=$param_nm_bd",$param_utilisateur,$param_mot_passe);
	$bdd->exec("SET NAMES uft8");
}
catch(Exception $e)    
{
	echo "Erreur :".$e->getMessage()."<br>";
	echo "N° : ".$e->getCode();
}
?>