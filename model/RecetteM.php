<?php

class Recette
{
    private $id_rec;
    private $titre;
    private $categorie;
    private $instructions;
    private $image_url;

    // Constructeur
    public function __construct($titre = null, $categorie = null, $instructions = null, $image_url = null)
    {
        $this->titre = $titre;
        $this->categorie = $categorie;
        $this->instructions = $instructions;
        $this->image_url = $image_url;
    }

    // Getters
    public function getIdRec()
    {
        return $this->id_rec;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function getInstructions()
    {
        return $this->instructions;
    }

    public function getImage()
    {
        return $this->image_url;
    }

    // Setters
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    public function setInstructions($instructions)
    {
        $this->instructions = $instructions;
    }

    public function setImage($image)
    {
        $this->image_url = $image;
    }

    // Méthodes CRUD (exemple d'insertion)
}