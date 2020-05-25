<?php

  require_once ('config/autoload.php');

  session_start();

  require_once ('config/db.php' );
 // On appelle session_start() APRÈS avoir enregistré l'autoload.

if (isset($_GET['deconnexion']))
{
  session_destroy();
  header('Location: index.php');
  exit();
}

$manager = new PersonnagesManager($db);

  if (isset($_SESSION['perso'])) // Si la session perso existe, on restaure l'objet.
  {
    $perso = $_SESSION['perso'];
  }

  if (isset($_POST['creer']) && isset($_POST['nom'])) // Si on a voulu créer un personnage.
  {
    $perso = new Personnage(['nom' => $_POST['nom']]); // On crée un nouveau personnage.
  
  if (!$perso->nomValide())
  {
    $message = 'Le nom choisi est invalide.';
    unset($perso);
  }
  else if ($manager->exists($perso->nom()))
  {
    $message = 'Le nom du personnage est déjà pris.';
    unset($perso);
  }
  else
  {
    $manager->add($perso);
  }
}

elseif (isset($_POST['utiliser']) && isset($_POST['nom'])) // Si on a voulu utiliser un personnage.
{
  if ($manager->exists($_POST['nom'])) // Si celui-ci existe.
  {
    $perso = $manager->get($_POST['nom']);
  }
  else
  {
    $message = 'Ce personnage n\'existe pas !'; // S'il n'existe pas, on affichera ce message.
  }
}

elseif (isset($_GET['frapper'])) // Si on a cliqué sur un personnage pour le frapper.
{
  if (!isset($perso))
  {
    $message = 'Merci de créer un personnage ou de vous identifier.';
  }
  
  else
  {
    if (!$manager->exists((int) $_GET['frapper']))
    {
      $message = 'Le personnage que vous voulez frapper n\'existe pas !';
    }
    
    else
    {
      $persoAFrapper = $manager->get((int) $_GET['frapper']);
      
      $retour = $perso->frapper($persoAFrapper); // On stocke dans $retour les éventuelles erreurs ou messages que renvoie la méthode frapper.
      
      switch ($retour)
      {
        case Personnage::CEST_MOI :
          $message = 'Mais... pourquoi voulez-vous vous frapper ???';
          break;
        
        case Personnage::PERSONNAGE_FRAPPE :
          $message = 'Le personnage a bien été frappé !';
          
          $manager->update($perso);
          $manager->update($persoAFrapper);
          
          break;
        
        case Personnage::PERSONNAGE_TUE :
          $message = 'Vous avez tué ce personnage !';
          
          $manager->update($perso);
          $manager->delete($persoAFrapper);
          
          break;
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Pangolin&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,100&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<p>Nombre de personnages créés : <?= $manager->count() ?></p>
<div class="box">
    <div class="box1">
<?php
if (isset($message)) // On a un message à afficher ?
{
  echo '<p>', $message, '</p>'; // Si oui, on l'affiche.
}

if (isset($perso)) // Si on utilise un personnage (nouveau ou pas).
{
?>
  
        <p><a href="?deconnexion=1">Déconnexion</a></p>
        
        <fieldset>
          <legend>Mes informations</legend>
          <p>
            Nom : <?= htmlspecialchars($perso->nom()) ?><br />
            Dégâts : <?= $perso->degats() ?>
          </p>
        </fieldset>
        
        <fieldset>
          <legend>Qui frapper ?</legend>
          <p>
   
<?php
$persos = $manager->getList($perso->nom());

if (empty($persos))
{
  echo 'Personne à frapper !';
}

else
{
  foreach ($persos as $unPerso)
  {
    echo '<a href="?frapper=', $unPerso->id(), '">', htmlspecialchars($unPerso->nom()), '</a> (dégâts : ', $unPerso->degats(), ')<br />';
  }
}
?>
      </p>
    </fieldset>
<?php
}
else
{
?>
 </div>
  </div>
  <h1>Mini TP War game</h1>
   
   <div class="container-fluid">
        <h2>Sign into your account</h2>
        <hr>
        <div class="formulaire">
            <form action="" method="post">
                <p>
                    Nom : <input type="text" name="nom" maxlength="50" />
                    <input type="submit" value="Créer ce personnage" name="creer" />
                    <input type="submit" value="Utiliser ce personnage" name="utiliser" />
                </p>
            </form>
        </div>
    </div>
<?php
}
?>
  </body>
</html>
<?php
if (isset($perso)) // Si on a créé un personnage, on le stocke dans une variable session afin d'économiser une requête SQL.
{
  $_SESSION['perso'] = $perso;
}