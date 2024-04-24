<?php

namespace App\Controller;

use App\Entity\Frais;
use App\Form\Frais1Type;
use App\Repository\FraisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/note/frais')]
class NoteFraisController extends AbstractController
{
    #[Route('/', name: 'app_note_frais_index', methods: ['GET'])]
    public function index(FraisRepository $fraisRepository): Response
    {
        return $this->render('note_frais/index.html.twig', [
            'frais' => $fraisRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_note_frais_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $frai = new Frais();
        $form = $this->createForm(Frais1Type::class, $frai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $frai->setUser($this->getUser());
            $entityManager->persist($frai);
            $entityManager->flush();

            return $this->redirectToRoute('app_note_frais_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('note_frais/new.html.twig', [
            'frai' => $frai,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_note_frais_show', methods: ['GET'])]
    public function show(Frais $frai): Response
    {
        return $this->render('note_frais/show.html.twig', [
            'frai' => $frai,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_note_frais_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Frais $frai, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Frais1Type::class, $frai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_note_frais_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('note_frais/edit.html.twig', [
            'frai' => $frai,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_note_frais_delete', methods: ['POST'])]
    public function delete(Request $request, Frais $frai, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$frai->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($frai);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_note_frais_index', [], Response::HTTP_SEE_OTHER);
    }
}
