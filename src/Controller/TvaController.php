<?php

namespace App\Controller;

use App\Form\TvaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TvaController extends AbstractController
{
    #[Route('/tva', name: 'app_tva')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(TvaType::class);

        
        // on prend l'objet form qui va lire la request
        $form->handleRequest($request);

        // test si l'envoie en post et est valide est bien envoyé
        if ($form->isSubmitted() && $form->isValid()) {
            // creer une variable task qui est un tableau clé valeur
            // contenant les données envoyé en POST
            $data= $form->getData();

            $data['tva']=$data['prix']*0.2;

            // renvoie une twig contenant les données du form
            // avec la variable task
            return $this->render('tva/traitement.html.twig', [
                'mes_donnes'=>$data 
            ]);

            // dd($task);
        }



        return $this->renderForm('tva/index.html.twig', [
            'form_tva' => $form,
        ]);
    }
}
