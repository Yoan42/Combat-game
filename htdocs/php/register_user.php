<?php

//connexion à la BDD
include 'connexion.php';

// récupération des valeurs du formulaire
$nickname = $_POST['name'];

$inserUser = $db->prepare("INSERT INTO personnages (name) VALUES (?) ");
                            
$inserUser->execute ([
        $name
]);

header( 'location: ../index.php');