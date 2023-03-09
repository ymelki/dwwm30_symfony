<?php

// espace de nom : comme un dossier virtuelle
// App\Controller => dans cet sorte de dossier que se trouve mon controlleur 
// ranger nos fichiers
namespace App\Controller;

// il n y a pas de include qui reprend les classes : Autochargement des classes est réalisé
// grâce à composer qui a généré une fichier permettant de charger automatiquement les fichiers
// lorsqu'on les demandes
// le use est utile parce que les classes sont stocké dans des namespaces
// pour faire appel a ces classes il faut préciser tout le namespace
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloController extends AbstractController
{
    #[Route('/hello', name: 'app_hello')]
    public function index(Request $request): Response
    {
        // equivalent de echo $_GET['id'];
        echo $_GET['id'];
        // $resquest objet issue de la classe Request
        // permettant de recoder de façon plus aboutie
        // les $_GET $_POST  ...
        echo $request->query->get('id','vide');


        // dd vardump and die 
        // vardump afficher un objet en php
        // die arreter le code
        dd($request);
        return $this->render('hello/index.html.twig', [
            'controller_name' => 'HelloController',
        ]);
    }
}
