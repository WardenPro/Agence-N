<?php

namespace App\Controller;

use App\Entity\ListeFrais;
use App\Form\ListeFrais1Type;
use App\Repository\ListeFraisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/liste/frais')]
class ListeFraisController extends AbstractController
{
    #[Route('/', name: 'app_liste_frais_index', methods: ['GET'])]
    public function index(ListeFraisRepository $listeFraisRepository): Response
    {
        return $this->render('liste_frais/index.html.twig', [
            'liste_frais' => $listeFraisRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_liste_frais_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $listeFrai = new ListeFrais();
        $form = $this->createForm(ListeFrais1Type::class, $listeFrai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($listeFrai);
            $entityManager->flush();

            return $this->redirectToRoute('app_liste_frais_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('liste_frais/new.html.twig', [
            'liste_frai' => $listeFrai,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_liste_frais_show', methods: ['GET'])]
    public function show(ListeFrais $listeFrai): Response
    {
        return $this->render('liste_frais/show.html.twig', [
            'liste_frai' => $listeFrai,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_liste_frais_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ListeFrais $listeFrai, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ListeFrais1Type::class, $listeFrai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_liste_frais_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('liste_frais/edit.html.twig', [
            'liste_frai' => $listeFrai,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_liste_frais_delete', methods: ['POST'])]
    public function delete(Request $request, ListeFrais $listeFrai, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$listeFrai->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($listeFrai);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_liste_frais_index', [], Response::HTTP_SEE_OTHER);
    }
}
