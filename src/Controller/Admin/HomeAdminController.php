<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeAdminController extends AbstractController
{
    #[Route('/admin', name: 'app_home_admin')]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function index(): Response
    {
        return $this->render('home_admin/index.html.twig', [
            'controller_name' => 'HomeAdminController',
        ]);
    }
}
