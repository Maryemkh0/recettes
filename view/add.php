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

        #confirmationMessage {
            display: none;
            background-color: #FF5722; /* Rouge orangé */
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }

        .error {
            color: #FF5722;
            margin-top: 5px;
            font-size: 0.9rem;
        }

        /* Style de la table des recettes */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>

</head>
<body>
    <div class="container">
        <header>
            <h1>Ajouter une Recette</h1>
        </header>

        <!-- Formulaire d'ajout de recette -->
        <form id="ajoutRecetteForm" action="ajouterRecetteHandle.php" method="POST">
            <div class="form-group">
                <label for="titre">Titre :</label>
                <input type="text" id="titre" name="titre" placeholder="Entrez le titre de la recette">
                <div id="titreError" class="error"></div>
            </div>

            <div class="form-group">
                <label for="categorie">Catégorie :</label>
                <input type="text" id="categorie" name="categorie" placeholder="Entrez la catégorie">
                <div id="categorieError" class="error"></div>
            </div>

            <div class="form-group">
                <label for="instructions">Instructions :</label>
                <textarea id="instructions" name="instructions" placeholder="Entrez les instructions"></textarea>
                <div id="instructionsError" class="error"></div>
            </div>

            <div class="form-group">
                <label for="image_url">URL de l'image :</label>
                <input type="url" id="image_url" name="image_url" placeholder="Entrez l'URL de l'image">
                <div id="imageUrlError" class="error"></div>
            </div>

            <div class="form-group">
                <button type="submit" class="submit-btn">Ajouter</button>
            </div>
        </form>

        <!-- Message de confirmation -->
        <div id="confirmationMessage" class="confirmation-message">
            <p>Recette ajoutée avec succès !</p>
        </div>

        <!-- Liste des recettes -->
        <div id="recettesList">
            <!-- La liste des recettes sera affichée ici après ajout -->
        </div>
    </div>

    <!-- JS interne pour la gestion dynamique -->
    <script>
        document.querySelector('#ajoutRecetteForm').addEventListener('submit', function(event) {
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
                document.getElementById('categorieError').textContent = 'La catégorie est requise.';
                isValid = false;
            }
            if (!instructions) {
                document.getElementById('instructionsError').textContent = 'Les instructions sont requises.';
                isValid = false;
            }
            if (!imageUrl) {
                document.getElementById('imageUrlError').textContent = 'L\'URL de l\'image est requise.';
                isValid = false;
            }

            // Si tout est valide, envoyer via AJAX et ajouter à la liste
            if (isValid) {
                // Envoi des données via AJAX
                const formData = new FormData();
                formData.append('titre', titre);
                formData.append('categorie', categorie);
                formData.append('instructions', instructions);
                formData.append('image_url', imageUrl);

                fetch('ajouterRecetteHandle.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Afficher un message de confirmation
                        document.getElementById('confirmationMessage').style.display = 'block';

                        // Réinitialiser le formulaire
                        document.querySelector('#ajoutRecetteForm').reset();

                        // Cacher le message de confirmation après 3 secondes
                        setTimeout(function() {
                            document.getElementById('confirmationMessage').style.display = 'none';
                        }, 3000);

                        // Ajouter la nouvelle recette à la liste
                        const recetteHTML = `
                            <div class="recette">
                                <h3>${data.titre}</h3>
                                <p><strong>Catégorie:</strong> ${data.categorie}</p>
                                <p><strong>Instructions:</strong> ${data.instructions}</p
