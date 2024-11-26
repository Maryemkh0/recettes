<?php

// Inclure les fichiers nécessaires
include 'C:/xampp/htdocs/projet/config.php'; // Inclure la configuration (classe config)
include 'C:/xampp/htdocs/projet/controller/RecetteC.php'; // Inclure le contrôleur

include 'C:/xampp/htdocs/projet/view/ajouterRecetteHandle.php';
$controller = new RecetteController(); // Instancier le contrôleur

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Recette</title>
</head>
<body>
    <h1>Ajouter une Recette</h1>
    <form action="ajouterRecetteHandle.php" method="POST">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" placeholder="Entrez le titre de la recette" required>
        <br><br>

        <label for="categorie">Categorie :</label>
        <input type="text" id="categorie" name="categorie" placeholder="Entrez la catégorie" required>
        <br><br>

        <label for="instructions">Instructions :</label>
        <textarea id="instructions" name="instructions" placeholder="Entrez les instructions" required></textarea>
        <br><br>

        <label for="image_url">URL de l'image :</label>
        <input type="url" id="image_url" name="image_url" placeholder="Entrez l'URL de l'image" required>
        <br><br>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
