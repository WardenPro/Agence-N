<?php

namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use App\Repository\CongeRepository;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Conge;

class ChoixCongeController extends AbstractController
{

    #[Route('/choix_conge', name: 'choix_conge')]
    public function index(CongeRepository $congeRepository): Response
    {
        $conges = $congeRepository->findAll(); // Récupère toutes les demandes de congé

        return $this->render('choix_conge/index.html.twig', [
            'conges' => $conges
        ]);
    }
    #[Route('/choix_conge/accepter/{id}', name: 'accepter_conge')]
    public function accepterConge($id, EntityManagerInterface $entityManager): Response
    {
        $conge = $entityManager->getRepository(Conge::class)->find($id);

        if (!$conge) {
            throw $this->createNotFoundException('La demande de congé n\'existe pas.');
        }

        if (!$this->isGranted('ROLE_RH') && !$this->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Accès refusé.');
        }

        $conge->setStatus('Accepté');
        $entityManager->flush();

        return $this->redirectToRoute('choix_conge');
    }

    #[Route('/choix_conge/refuser/{id}', name: 'refuser_conge')]
    public function refuserConge($id, EntityManagerInterface $entityManager): Response
    {
        $conge = $entityManager->getRepository(Conge::class)->find($id);
    
        if (!$conge) {
            throw $this->createNotFoundException('La demande de congé n\'existe pas.');
        }
    
        if (!$this->isGranted('ROLE_RH') && !$this->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Accès refusé.');
        }
    
        $conge->setStatus('Refusé');
        $entityManager->flush();
    
        return $this->redirectToRoute('choix_conge');
    }
}