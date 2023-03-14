<?php

namespace App\Controller;

use App\Entity\Rcategorie;
use App\Form\RcategorieType;
use App\Repository\RcategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rcategorie')]
class RcategorieController extends AbstractController
{
    #[Route('/', name: 'app_rcategorie_index', methods: ['GET'])]
    public function index(RcategorieRepository $rcategorieRepository): Response
    {
        return $this->render('rcategorie/index.html.twig', [
            'rcategories' => $rcategorieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_rcategorie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RcategorieRepository $rcategorieRepository): Response
    {
        $rcategorie = new Rcategorie();
        $form = $this->createForm(RcategorieType::class, $rcategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rcategorieRepository->save($rcategorie, true);

            return $this->redirectToRoute('app_rcategorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rcategorie/new.html.twig', [
            'rcategorie' => $rcategorie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rcategorie_show', methods: ['GET'])]
    public function show(Rcategorie $rcategorie): Response
    {
        return $this->render('rcategorie/show.html.twig', [
            'rcategorie' => $rcategorie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_rcategorie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rcategorie $rcategorie, RcategorieRepository $rcategorieRepository): Response
    {
        $form = $this->createForm(RcategorieType::class, $rcategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rcategorieRepository->save($rcategorie, true);

            return $this->redirectToRoute('app_rcategorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rcategorie/edit.html.twig', [
            'rcategorie' => $rcategorie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rcategorie_delete', methods: ['POST'])]
    public function delete(Request $request, Rcategorie $rcategorie, RcategorieRepository $rcategorieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rcategorie->getId(), $request->request->get('_token'))) {
            $rcategorieRepository->remove($rcategorie, true);
        }

        return $this->redirectToRoute('app_rcategorie_index', [], Response::HTTP_SEE_OTHER);
    }
}
