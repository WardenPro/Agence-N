<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FraisRepository;
use App\Entity\Frais;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ChoixFraisController extends AbstractController
{
    #[Route('/choix_frais', name: 'choix_note_frais')]
    public function index(FraisRepository $noteFraisRepository): Response
    {
        $notesFrais = $noteFraisRepository->findAll(); // Récupère toutes les notes de frais
    
        return $this->render('choix_frais/index.html.twig', [
            'notes_frais' => $notesFrais
        ]);
    }
    
    #[Route('/choix_frais/valider/{id}', name: 'valider_note_frais')]
    public function validerNoteFrais($id, EntityManagerInterface $entityManager): Response
    {
        $noteFrais = $entityManager->getRepository(Frais::class)->find($id);
    
        if (!$noteFrais) {
            throw $this->createNotFoundException('La note de frais n\'existe pas.');
        }
    
        if (!$this->isGranted('ROLE_COMPTA') && !$this->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Accès refusé.');
        }
    
        $noteFrais->setStatus('Validée');
        $entityManager->flush();
    
        return $this->redirectToRoute('choix_note_frais');
    }
    
    #[Route('/choix_frais/refuser/{id}', name: 'refuser_note_frais')]
    public function refuserNoteFrais($id, EntityManagerInterface $entityManager): Response
    {
        $noteFrais = $entityManager->getRepository(Frais::class)->find($id);
    
        if (!$noteFrais) {
            throw $this->createNotFoundException('La note de frais n\'existe pas.');
        }
    
        if (!$this->isGranted('ROLE_COMPTA') && !$this->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Accès refusé.');
        }
    
        $noteFrais->setStatus('Refusée');
        $entityManager->flush();
    
        return $this->redirectToRoute('choix_note_frais');
    }
}
