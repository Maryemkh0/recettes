
<?php
    include 'C:/xampp/htdocs/projet/model/RecetteM.php' ;
    include_once 'C:/xampp/htdocs/projet/config.php';
    class RecetteController
{
   
    public function AjouterRecettes($recettes)
    {
        $sql = "INSERT INTO recettes (titre, categorie, instructions, image_url) 
                VALUES (:titre, :categorie, :instructions, :image_url)";
        $db = config::getConnexion(); // Connexion à la base de données
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'titre' => $recettes->getTitre(),
                'categorie' => $recettes->getCategorie(),
                'instructions' => $recettes->getInstructions(),
                'image_url' => $recettes->getImage(),
            ]);
            echo "Recette ajoutée avec succès.";
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
    public function AfficherRecettes()
    {
        $sql = "SELECT * FROM recettes";
        $db = config::getConnexion(); // Connexion à la base de données
        try {
            $query = $db->query($sql); // Exécuter la requête
            return $query->fetchAll(PDO::FETCH_ASSOC); // Retourner toutes les données
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    public function SupprimerRecette($id_rec)
{
    $sql = "DELETE FROM recettes WHERE id_rec = :id_rec";
    $db = config::getConnexion(); // Connexion à la base de données
    try {
        $query = $db->prepare($sql);
        $query->execute(['id_rec' => $id_rec]); // Exécuter la requête avec l'ID de la recette
        echo "Recette supprimée avec succès.";
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
public function ModifierRecette($id_rec, $recette)
{
    $sql = "UPDATE recettes 
            SET titre = :titre, categorie = :categorie, instructions = :instructions, image_url = :image_url 
            WHERE id_rec = :id_rec";
    $db = config::getConnexion(); // Connexion à la base de données
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'id_rec' => $id_rec,
            'titre' => $recette->getTitre(),
            'categorie' => $recette->getCategorie(),
            'instructions' => $recette->getInstructions(),
            'image_url' => $recette->getImage(),
        ]);
        echo "Recette mise à jour avec succès.";
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}

    

  /*
    function AfficherRecettes(){
            
        $sql="SELECT * FROM recettes";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }   
    }
*/

}