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
#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'app_admin')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin/index.html.twig', [
                'users' => $userRepository->findAll(),
            ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/promotion', name: 'app_admin_promo', methods: ['GET'])]
    public function promotion(string $id, Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager ): Response
    {

        $user =  $userRepository->findOneBy(['username' => $id]);


        if (in_array('ROLE_ELEVE', $user->getRoles())) {
            $user->setRoles(['ROLE_PROFESSEUR']);
        } else {
            $user->setRoles(['ROLE_ELEVE']);
        }
        $entityManager->flush();
        return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/superpromotion', name: 'app_admin_superpromo', methods: ['GET'])]
    public function superpromotion(string $id, Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager ): Response
    {

        $user =  $userRepository->findOneBy(['username' => $id]);


        if (in_array('ROLE_PROFESSEUR', $user->getRoles())) {
            $user->setRoles(['ROLE_ADMIN']);
        } 
        $entityManager->flush();
        return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
    }

}
