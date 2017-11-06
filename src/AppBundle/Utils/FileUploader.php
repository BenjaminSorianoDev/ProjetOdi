<?php

namespace AppBundle\Utils;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $chemin;

    public function __construct($chemin)
    {
        $this->chemin = $chemin;
    }

    public function upload(UploadedFile $fichier)
    {
        $nomFichier = md5(uniqid()).'.'.$fichier->guessExtension();

        $fichier->move($this->chemin, $nomFichier);

        return $nomFichier;
    }
}