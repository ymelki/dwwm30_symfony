<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
 
        // on prend l'objet form qui va lire la request
        $form->handleRequest($request);

        // test si l'envoie en post et est valide est bien envoyé
        if ($form->isSubmitted() && $form->isValid()) {
            // creer une variable task qui est un tableau clé valeur
            // contenant les données envoyé en POST
            $data= $form->getData();

            // renvoie une twig contenant les données du form
            // avec la variable task
            return $this->render('contact/traitement.html.twig', [
                'mes_donnes'=>$data 
            ]);

            // dd($task);
        }


        return $this->renderForm('contact/index.html.twig', [
            'mon_form'=>$form,
        ]);
    }
}
