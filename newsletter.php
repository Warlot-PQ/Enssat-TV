<?php
$mail = $_POST["mail"];
//initialisation du message :
$msg = "Newsletter ENSSAT TV - Un utilisateur souhaite s'inscrire : $mail";

//envoi du message
mail('kvythel@gmail.com', 'Inscription newsletter ENSSAT TV', $msg);
?>
