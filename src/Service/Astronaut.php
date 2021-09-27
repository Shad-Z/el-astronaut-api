<?php

namespace App\Service;

use Symfony\Component\Form\FormInterface;

class Astronaut
{
    /**
     * Retourne la liste des erreurs du formulaire Astronaut
     * @param FormInterface $form
     * @return array
     */
    public function getFormErrors(FormInterface $form): array
    {
        $errors = [];
        foreach ($form->getErrors(true) as $error) {
            $errors[] = $error->getMessage();
        }

        return $errors;
    }
}
