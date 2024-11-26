<?php
include_once 'C:/xampp/htdocs/projet/config.php'; // Inclure la configuration
include_once 'C:/xampp/htdocs/projet/controller/RecetteC.php'; // Inclure le contrôleur
include_once 'C:/xampp/htdocs/projet/model/RecetteM.php'; // Inclure le modèle

// Vérifier si les données ont été envoyées via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $id_rec = $_POST['id_rec'];
    $titre = $_POST['titre'];
    $categorie = $_POST['categorie'];
    $instructions = $_POST['instructions'];
    $image_url = $_POST['image_url'];

    // Créer une instance de la recette avec les nouvelles données
    $recette = new Recette($titre, $categorie, $instructions, $image_url);

    // Créer une instance du contrôleur
    $controller = new RecetteController();
    
    // Appeler la méthode pour mettre à jour la recette
    $controller->ModifierRecette($id_rec, $recette);

    // Rediriger vers la page d'affichage des recettes après mise à jour
    header('Location: afficher_recettes.php');
    exit();
} else {
    echo "Aucune donnée reçue.";
}
?>
