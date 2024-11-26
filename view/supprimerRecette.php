<?php
include_once 'C:/xampp/htdocs/projet/config.php'; // Inclure la configuration
include_once 'C:/xampp/htdocs/projet/controller/RecetteC.php'; // Inclure le contrôleur

// Vérifier si l'ID est passé dans la requête POST
if (isset($_POST['id_rec'])) {
    $id_rec = $_POST['id_rec'];

    // Créer une instance du contrôleur
    $controller = new RecetteController();
    
    // Appeler la méthode pour supprimer la recette
    $controller->SupprimerRecette($id_rec);

    // Rediriger vers la page d'affichage des recettes après suppression
    header('Location: afficher_recettes.php');
    exit();
} else {
    echo 'ID de recette non spécifié.';
}
?>
