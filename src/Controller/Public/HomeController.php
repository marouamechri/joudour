<?php

namespace App\Controller\Public;

use App\Repository\ImagewebSiteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(ImagewebSiteRepository $imagewebSiteRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'imageweb' => $imagewebSiteRepository->findAll() ,
        ]);
    }
   
}
