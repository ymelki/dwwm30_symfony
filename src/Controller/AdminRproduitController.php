<?php

namespace App\Controller;

use App\Entity\Rproduit;
use App\Form\Rproduit1Type;
use App\Repository\RproduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/rproduit')]
class AdminRproduitController extends AbstractController
{
    #[Route('/', name: 'app_admin_rproduit_index', methods: ['GET'])]
    public function index(RproduitRepository $rproduitRepository): Response
    {
        return $this->render('admin_rproduit/index.html.twig', [
            'rproduits' => $rproduitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_rproduit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RproduitRepository $rproduitRepository): Response
    {
        $rproduit = new Rproduit();
        $form = $this->createForm(Rproduit1Type::class, $rproduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rproduitRepository->save($rproduit, true);

            return $this->redirectToRoute('app_admin_rproduit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_rproduit/new.html.twig', [
            'rproduit' => $rproduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_rproduit_show', methods: ['GET'])]
    public function show(Rproduit $rproduit): Response
    {
        return $this->render('admin_rproduit/show.html.twig', [
            'rproduit' => $rproduit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_rproduit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rproduit $rproduit, RproduitRepository $rproduitRepository): Response
    {
        $form = $this->createForm(Rproduit1Type::class, $rproduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rproduitRepository->save($rproduit, true);

            return $this->redirectToRoute('app_admin_rproduit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_rproduit/edit.html.twig', [
            'rproduit' => $rproduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_rproduit_delete', methods: ['POST'])]
    public function delete(Request $request, Rproduit $rproduit, RproduitRepository $rproduitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rproduit->getId(), $request->request->get('_token'))) {
            $rproduitRepository->remove($rproduit, true);
        }

        return $this->redirectToRoute('app_admin_rproduit_index', [], Response::HTTP_SEE_OTHER);
    }
}
