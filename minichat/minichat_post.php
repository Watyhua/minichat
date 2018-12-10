<?php
session_start();
//redirection vers minichat.php
header('location: minichat.php');

$pseudo =htmlspecialchars($_POST['pseudo']);
$msg =htmlspecialchars($_POST['message']);
//$_COOKIE=($_POST['pseudo']);

setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);

try {
	// On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
} catch (Exception $e) {
	// En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}
$insert=$bdd->prepare("INSERT INTO minichat(dates,pseudo, messages) VALUES(NOW(),' " .$pseudo. " ',' ".$msg. "');");
$insert->execute(array($pseudo,$msg));
?> 