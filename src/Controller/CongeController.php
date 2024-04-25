<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Conge;
use App\Form\CongeType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface; 
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class CongeController extends AbstractController
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    #[Route("/notification/mark-as-seen", name:"mark_notifications_as_seen")]
    public function markAsSeen(EntityManagerInterface $em): Response
    {
        $token = $this->tokenStorage->getToken();
        if (null !== $token && is_object($user = $token->getUser())) {
            $em->getRepository(Conge::class)->createQueryBuilder('c')
                ->update()
                ->set('c.seen', ':seen')
                ->where('c.user = :user')
                ->setParameter('seen', true)
                ->setParameter('user', $user)
                ->getQuery()
                ->execute();
    
            // Rediriger vers l'URL /mes_conges
            return $this->redirectToRoute('mes_conge');
        }
    
        // Si l'utilisateur n'est pas trouvé, rediriger vers une page d'erreur par exemple
        return $this->redirectToRoute('app_error');
    }

     #[Route("/notification/count", name:"count_notifications")]
    public function countNotifications(EntityManagerInterface $em): JsonResponse
    {
        $token = $this->tokenStorage->getToken();
        if (null !== $token && is_object($user = $token->getUser())) {
            $count = $em->getRepository(Conge::class)->createQueryBuilder('c')
                ->select('count(c.id)')
                ->where('c.user = :user')
                ->andWhere('c.seen = :seen')
                ->andWhere('c.status IN (:status)')
                ->setParameter('user', $user)
                ->setParameter('seen', false)
                ->setParameter('status', ['accepté', 'refusé'])
                ->getQuery()
                ->getSingleScalarResult();
    
            return new JsonResponse(['count' => $count]);
        }
    
        return new JsonResponse(['count' => 0]);
    }

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
