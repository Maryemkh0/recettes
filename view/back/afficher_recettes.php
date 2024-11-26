<?php
include 'C:/xampp/htdocs/projet/controller/RecetteC.php'; // Inclure le contrôleur

$controller = new RecetteController(); // Instancier le contrôleur
$recettes = $controller->AfficherRecettes(); // Récupérer la liste des recettes
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Recettes</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
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
    <h1>Liste des Recettes</h1>
    <table>
        <thead>
            <tr>
                <th>ID Recette</th>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Instructions</th>
                <th>Image</th>
                <th>action</th>
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
                                <img src="<?php echo htmlspecialchars($recette['image_url']); ?>" alt="Image de <?php echo htmlspecialchars($recette['titre']); ?>" style="max-width: 100px;">
                            <?php else: ?>
                                Pas d'image
                            <?php endif; ?>
                        </td>
                        <td>
                    <form action="supprimerRecette.php" method="POST">
                        <input type="hidden" name="id_rec" value="<?php echo htmlspecialchars($recette['id_rec']); ?>">
                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?')">Supprimer</button>
                    </form>
                    <form action="modifierRecette.php" method="GET" >
                                <input type="hidden" name="id_rec" value="<?php echo htmlspecialchars($recette['id_rec']); ?>">
                                <button type="submit">Modifier</button>
                            </form>



                    
                </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Aucune recette disponible.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
