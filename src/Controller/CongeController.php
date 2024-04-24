<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Conge;
use App\Form\CongeType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface; 

class CongeController extends AbstractController
{
    #[Route('/demande_conge', name: 'app_conge')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $demande = new Conge();
        $form = $this->createForm(CongeType::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $demande->setUser($this->getUser());
            $entityManager->persist($demande);
            $entityManager->flush();

            return $this->redirectToRoute('app_index');
        }

        return $this->render('conge/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
