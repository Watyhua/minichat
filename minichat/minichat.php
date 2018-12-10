<?php
session_start();
// echo $_COOKIE['pseudo'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylechat.css">
    <link href="https://fonts.googleapis.com/css?family=Medula+One" rel="stylesheet">
    <title>minitchat</title>
</head>
<body>
    <h1><img src="headerwow.png" alt=""></h1>
    
    <div class="main_container">
    <form action="minichat_post.php" method="post" id ="formulaire ">
    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo" class="pseudo" value="<?php if (isset($_COOKIE['pseudo'])) {
                                                                            echo $_COOKIE['pseudo'];
                                                                        }
                                                                        ?>
        ">
    <br>
    <label for="message">Message</label>
    <input type="textarea" id="message" name="message" class="message">
    <br>
    <input type="submit" value="envoyer" class="bouton">
    <input type="button" onclick='window.location.reload(false)' value="Actualiser" class="bouton">
    </form>
</div>  
    <div class="texte" id="text">
    <?php
    try {
            // On se connecte à MySQL
        $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
    } catch (Exception $e) {
            // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }
    $reponse = $bdd->query('SELECT pseudo, messages, DATE_FORMAT(dates, "%d/%m/%Y %Hh%imin%ss") AS dates_fr FROM minichat  ORDER BY id DESC LIMIT 0, 10');

    while ($donnees = $reponse->fetch()) {
        echo $donnees['dates_fr'] . '<strong>' . $donnees['pseudo'] . '</strong> :' . $donnees['messages'] . '<br>';
    }
    ?>
    </div>
</body>
</html>
