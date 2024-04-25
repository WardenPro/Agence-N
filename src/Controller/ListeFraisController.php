<?php

namespace App\Controller;

use App\Entity\Frais;
use App\Entity\ListeFrais;
use App\Form\ListeFrais1Type;
use App\Repository\ListeFraisRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FraisRepository;

#[Route('/note/{noteId}/liste/frais')]
class ListeFraisController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/', name: 'app_liste_frais_index', methods: ['GET'])]
    public function index(int $noteId, ListeFraisRepository $listeFraisRepository): Response
    {
        return $this->render('liste_frais/index.html.twig', [
            'liste_frais' => $listeFraisRepository->findAll(),
            'noteId' => $noteId
        ]);
    }

    #[Route('/new', name: 'app_liste_frais_new', methods: ['GET', 'POST'])]
    public function new(Request $request, int $noteId, EntityManagerInterface $entityManager): Response
    {
        $listeFrai = new ListeFrais();
        $form = $this->createForm(ListeFrais1Type::class, $listeFrai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $listeFrai->setFrais($this->entityManager->getReference(Frais::class, $noteId));
            $entityManager->persist($listeFrai);
            $entityManager->flush();

            return $this->redirectToRoute('app_liste_frais_index', ['noteId' => $noteId], Response::HTTP_SEE_OTHER);
        }

        return $this->render('liste_frais/new.html.twig', [
            'liste_frai' => $listeFrai,
            'form' => $form,
            'noteId' => $noteId
        ]);
    }

    #[Route('/{id}', name: 'app_liste_frais_show', methods: ['GET'])]
    public function show(int $noteId, ListeFrais $listeFrai): Response
    {
        return $this->render('liste_frais/show.html.twig', [
            'liste_frai' => $listeFrai,
            'noteId' => $noteId
        ]);
    }

    #[Route('/{id}/edit', name: 'app_liste_frais_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $noteId, ListeFrais $listeFrai, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ListeFrais1Type::class, $listeFrai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_liste_frais_index', ['noteId' => $noteId], Response::HTTP_SEE_OTHER);
        }

        return $this->render('liste_frais/edit.html.twig', [
            'liste_frai' => $listeFrai,
            'form' => $form,
            'noteId' => $noteId

        ]);
    }

    #[Route('/{id}', name: 'app_liste_frais_delete', methods: ['POST'])]
    public function delete(Request $request,int $noteId, ListeFrais $listeFrai, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$listeFrai->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($listeFrai);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_liste_frais_index', ['noteId' => $noteId], Response::HTTP_SEE_OTHER);
    }
}
