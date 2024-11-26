<?php
include_once 'C:/xampp/htdocs/projet/config.php'; // Inclure la configuration
include_once 'C:/xampp/htdocs/projet/controller/RecetteC.php'; // Inclure le contrôleur

// Vérifier si l'ID est passé dans la requête GET
if (isset($_GET['id_rec'])) {
    $id_rec = $_GET['id_rec'];

    // Récupérer la recette à modifier
    $controller = new RecetteController();
    $recettes = $controller->AfficherRecettes(); // Afficher toutes les recettes
    $recette_a_modifier = null;

    // Trouver la recette correspondant à l'ID
    foreach ($recettes as $recette) {
        if ($recette['id_rec'] == $id_rec) {
            $recette_a_modifier = $recette;
            break;
        }
    }
    
    // Si la recette n'est pas trouvée, afficher un message d'erreur
    if ($recette_a_modifier === null) {
        echo "Recette introuvable.";
        exit();
    }
} else {
    echo "ID de recette non spécifié.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier la Recette</title>
</head>
<body>
    <h1>Modifier la Recette</h1>
    <form action="modifierRecetteHandle.php" method="POST">
        <input type="hidden" name="id_rec" value="<?php echo htmlspecialchars($recette_a_modifier['id_rec']); ?>">

        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($recette_a_modifier['titre']); ?>" required>
        <br><br>

        <label for="categorie">Catégorie :</label>
        <input type="text" id="categorie" name="categorie" value="<?php echo htmlspecialchars($recette_a_modifier['categorie']); ?>" required>
        <br><br>

        <label for="instructions">Instructions :</label>
        <textarea id="instructions" name="instructions" required><?php echo htmlspecialchars($recette_a_modifier['instructions']); ?></textarea>
        <br><br>

        <label for="image_url">URL de l'image :</label>
        <input type="url" id="image_url" name="image_url" value="<?php echo htmlspecialchars($recette_a_modifier['image_url']); ?>" required>
        <br><br>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
