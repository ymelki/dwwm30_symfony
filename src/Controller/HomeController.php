<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/admin/test', name: 'app_home')]
    public function index(Request $request): Response
    {
        $formateur="Yoel";

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'mavariable' => 'ce que je veux',
            'nom_formateur'=> $formateur
        ]);
    }
}
