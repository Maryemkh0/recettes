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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la Recette</title>

    <!-- CSS interne pour la template -->
    <style>
        /* Style général */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #121212; /* Fond sombre */
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 80%;
            max-width: 600px;
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            color: #FF5722; /* Rouge orangé */
            font-size: 2rem;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #555;
            background-color: #222;
            color: white;
            font-size: 1rem;
        }

        input::placeholder, textarea::placeholder {
            color: #bbb;
        }

        button.submit-btn {
            padding: 10px 15px;
            background-color: #4CAF50; /* Vert */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button.submit-btn:hover {
            background-color: #45a049; /* Légère variation de vert au survol */
        }

        .error {
            color: #FF5722;
            margin-top: 5px;
            font-size: 0.9rem;
        }

    </style>

</head>
<body>
    <div class="container">
        <header>
            <h1>Modifier la Recette</h1>
        </header>

        <!-- Formulaire de modification de recette -->
        <form action="modifierRecetteHandle.php" method="POST">
            <input type="hidden" name="id_rec" value="<?php echo htmlspecialchars($recette_a_modifier['id_rec']); ?>">

            <div class="form-group">
                <label for="titre">Titre :</label>
                <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($recette_a_modifier['titre']); ?>" required>
                <div id="titreError" class="error"></div>
            </div>

            <div class="form-group">
                <label for="categorie">Catégorie :</label>
                <input type="text" id="categorie" name="categorie" value="<?php echo htmlspecialchars($recette_a_modifier['categorie']); ?>" required>
                <div id="categorieError" class="error"></div>
            </div>

            <div class="form-group">
                <label for="instructions">Instructions :</label>
                <textarea id="instructions" name="instructions" required><?php echo htmlspecialchars($recette_a_modifier['instructions']); ?></textarea>
                <div id="instructionsError" class="error"></div>
            </div>

            <div class="form-group">
                <label for="image_url">URL de l'image :</label>
                <input type="url" id="image_url" name="image_url" value="<?php echo htmlspecialchars($recette_a_modifier['image_url']); ?>" required>
                <div id="imageUrlError" class="error"></div>
            </div>

            <div class="form-group">
                <button type="submit" class="submit-btn">Mettre à jour</button>
            </div>
        </form>
    </div>

    <!-- JS interne pour la gestion dynamique -->
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault(); // Empêche la soumission réelle du formulaire

            // Récupère les valeurs des champs
            const titre = document.getElementById('titre').value.trim();
            const categorie = document.getElementById('categorie').value.trim();
            const instructions = document.getElementById('instructions').value.trim();
            const imageUrl = document.getElementById('image_url').value.trim();

            // Variables pour les erreurs
            let isValid = true;

            // Effacer les messages d'erreur
            document.getElementById('titreError').textContent = '';
            document.getElementById('categorieError').textContent = '';
            document.getElementById('instructionsError').textContent = '';
            document.getElementById('imageUrlError').textContent = '';

            // Vérification que les champs sont remplis
            if (!titre) {
                document.getElementById('titreError').textContent = 'Le titre est requis.';
                isValid = false;
            }
            if (!categorie) {
                document.getElementById('categorieError').tex
