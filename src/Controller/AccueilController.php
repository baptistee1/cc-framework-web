<?php

namespace App\Controller;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Request;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    #[Route('/', name: 'app_accueil2')]
    public function index(): Response
    {
       return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }


  

    

}
