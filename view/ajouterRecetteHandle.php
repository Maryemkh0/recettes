<?php

include_once 'C:/xampp/htdocs/projet/config.php'; // Inclure la configuration une seule fois
include_once 'C:/xampp/htdocs/projet/controller/RecetteC.php'; // Inclure le contrôleur une seule fois
include_once 'C:/xampp/htdocs/projet/model/RecetteM.php'; // Inclure le modèle une seule fois

// Vérifier si les données ont été envoyées
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $categorie = $_POST['categorie'];
    $instructions = $_POST['instructions'];
    $image_url = $_POST['image_url'];

    // Créer une nouvelle recette
    $recette = new Recette($titre, $categorie, $instructions, $image_url);

    // Ajouter la recette via le contrôleur
    $controller = new RecetteController();
    $controller->AjouterRecettes($recette);

    // Rediriger vers la page de confirmation ou la liste des recettes
    header('Location: afficher_recettes.php');
    exit();
}
?>
