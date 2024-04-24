<?php

namespace App\Controller;

use App\Entity\Frais;
use App\Form\FraisType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface; 
use Symfony\Component\HttpFoundation\Request;

class FraisController extends AbstractController
{
    #[Route('/note_frais', name: 'app_frais')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $frais = new Frais();
        
        $form = $this->createForm(FraisType::class, $frais);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $frais->setUser($this->getUser());
            $entityManager->persist($frais);
            $entityManager->flush();

            return $this->redirectToRoute('app_index');
        }


        return $this->render('frais/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    
}
