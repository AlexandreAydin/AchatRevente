<?php

namespace App\Service;

use Exception;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\KernelInterface;

class PictureService
{
    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function add(UploadedFile $picture, ?int $width = 300, ?int $height = 300): string
    {
        // On donne un nouveau nom à l'image
        $fichier = md5(uniqid(rand(), true)) . '.webp';
    
        // Chemin de destination de l'image redimensionnée
        $destinationPath = $this->kernel->getProjectDir() . '/public/uploads/articles/' . $fichier;
    
        try {
            // Redimensionner l'image à la taille spécifiée
            $manager = new \Intervention\Image\ImageManager(['driver' => 'gd']);
            $manager->make($picture->getPathname())->fit($width, $height)->save($destinationPath);
        } catch (\Exception $e) {
            throw new Exception('Erreur lors du redimensionnement de l\'image: ' . $e->getMessage());
        }
    
        return $fichier;
    }

    public function delete(string $fichier): bool
    {
        if ($fichier !== 'default.webp') {
            $success = false;

            if (file_exists($fichier)) {
                unlink($fichier);
                $success = true;
            }

            return $success;
        }

        return false;
    }
}
