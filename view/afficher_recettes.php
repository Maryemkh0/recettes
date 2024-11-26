<?php
include 'C:/xampp/htdocs/projet/controller/RecetteC.php'; // Inclure le contrôleur

$controller = new RecetteController(); // Instancier le contrôleur
$recettes = $controller->AfficherRecettes(); // Récupérer la liste des recettes
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Recettes</title>
    <style>
        /* Style général de la page */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #121212; /* Fond sombre */
            color: white;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #FF5722; /* Rouge orangé */
            margin-bottom: 20px;
            font-size: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #555;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #FF5722; /* Rouge orangé */
        }

        tr:nth-child(even) {
            background-color: #222;
        }

        tr:nth-child(odd) {
            background-color: #333;
        }

        td img {
            max-width: 100px;
            border-radius: 5px;
        }

        td button {
            background-color: #4CAF50; /* Vert */
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        td button:hover {
            background-color: #45a049; /* Légère variation de vert au survol */
        }

        td button:active {
            background-color: #388E3C; /* Couleur de fond au clic */
        }

        form {
            display: inline;
        }

        .no-image {
            color: #FF5722; /* Rouge orangé */
        }

        /* Message d'absence de recettes */
        .no-recipes {
            text-align: center;
            color: #FF5722; /* Rouge orangé */
            font-size: 1.2rem;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h1>Liste des Recettes</h1>

    <table>
        <thead>
            <tr>
                <th>ID Recette</th>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Instructions</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($recettes)): ?>
                <?php foreach ($recettes as $recette): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($recette['id_rec']); ?></td>
                        <td><?php echo htmlspecialchars($recette['titre']); ?></td>
                        <td><?php echo htmlspecialchars($recette['categorie']); ?></td>
                        <td><?php echo htmlspecialchars($recette['instructions']); ?></td>
                        <td>
                            <?php if (!empty($recette['image_url'])): ?>
                                <img src="<?php echo htmlspecialchars($recette['image_url']); ?>" alt="Image de <?php echo htmlspecialchars($recette['titre']); ?>">
                            <?php else: ?>
                                <span class="no-image">Pas d'image</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <!-- Formulaire pour supprimer la recette -->
                            <form action="supprimerRecette.php" method="POST">
                                <input type="hidden" name="id_rec" value="<?php echo htmlspecialchars($recette['id_rec']); ?>">
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?')">Supprimer</button>
                            </form>

                            <!-- Formulaire pour modifier la recette -->
                            <form action="modifierRecette.php" method="GET">
                                <input type="hidden" name="id_rec" value="<?php echo htmlspecialchars($recette['id_rec']); ?>">
                                <button type="submit">Modifier</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="no-recipes">Aucune recette disponible.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
