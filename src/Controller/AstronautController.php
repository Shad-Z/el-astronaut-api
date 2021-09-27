<?php

namespace App\Controller;

use App\Entity\Astronaut;
use App\Form\AstronautType;
use App\Repository\AstronautRepository;
use App\Service\Astronaut as AstronautService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/astronaut")
 */
class AstronautController extends AbstractController
{
    /**
     * Ajoute une nouvelle ressource Astronaut
     * @Route("", name="add_astronaut", methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param AstronautService $astronautService
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $em, AstronautService $astronautService): Response
    {
        $data = json_decode($request->getContent(), true);

        $astronaut = new Astronaut();
        $form = $this->createForm(AstronautType::class, $astronaut);

        $form->submit($data);

        if ($form->isValid()) {
            $em->persist($astronaut);
            $em->flush();

            return $this->json($astronaut, Response::HTTP_CREATED);
        }

        $errors = $astronautService->getFormErrors($form);

        return $this->json($errors, Response::HTTP_BAD_REQUEST);
    }

    /**
     * Récupère la liste des Astronaut
     * @Route("/list", name="list_astronaut", methods={"GET"})
     * @param AstronautRepository $astronautRepository
     * @return Response
     */
    public function list(AstronautRepository $astronautRepository): Response
    {
        $astronauts = $astronautRepository->findAll();

        return $this->json($astronauts);
    }
}
