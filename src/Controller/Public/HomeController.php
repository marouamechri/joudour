<?php

namespace App\Controller\Public;

use App\Repository\ImagewebSiteRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(ImagewebSiteRepository $imagewebSiteRepository, ProductRepository $productRepository): Response
    {
        $listeNewCollection_1 = $productRepository->findNewCollectionlimit(0);
        $listeNewCollection_2 =$productRepository->findNewCollectionlimit(3);
        $listeNewCollection_3=$productRepository->findNewCollectionlimit(6);
        // dd($listeNewCollection_1 , $listeNewCollection_2, $listeNewCollection_3);
        return $this->render('home/index.html.twig', [
            'imageweb' => $imagewebSiteRepository->findAll() ,
            'listeNewCollection_1'=>$listeNewCollection_1,
            'listeNewCollection_2'=>$listeNewCollection_2,
            'listeNewCollection_3'=>$listeNewCollection_3
        ]);
    }
   
}
