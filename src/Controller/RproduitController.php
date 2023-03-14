<?php

namespace App\Controller;

use App\Entity\Rproduit;
use App\Form\RproduitType;
use App\Repository\RproduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rproduit')]
class RproduitController extends AbstractController
{
    #[Route('/', name: 'app_rproduit_index', methods: ['GET'])]
    public function index(RproduitRepository $rproduitRepository): Response
    {
        return $this->render('rproduit/index.html.twig', [
            'rproduits' => $rproduitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_rproduit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RproduitRepository $rproduitRepository): Response
    {
        $rproduit = new Rproduit();
        $form = $this->createForm(RproduitType::class, $rproduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rproduitRepository->save($rproduit, true);

            return $this->redirectToRoute('app_rproduit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rproduit/new.html.twig', [
            'rproduit' => $rproduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rproduit_show', methods: ['GET'])]
    public function show(Rproduit $rproduit): Response
    {
        return $this->render('rproduit/show.html.twig', [
            'rproduit' => $rproduit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_rproduit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rproduit $rproduit, RproduitRepository $rproduitRepository): Response
    {
        $form = $this->createForm(RproduitType::class, $rproduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rproduitRepository->save($rproduit, true);

            return $this->redirectToRoute('app_rproduit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rproduit/edit.html.twig', [
            'rproduit' => $rproduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rproduit_delete', methods: ['POST'])]
    public function delete(Request $request, Rproduit $rproduit, RproduitRepository $rproduitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rproduit->getId(), $request->request->get('_token'))) {
            $rproduitRepository->remove($rproduit, true);
        }

        return $this->redirectToRoute('app_rproduit_index', [], Response::HTTP_SEE_OTHER);
    }
}
