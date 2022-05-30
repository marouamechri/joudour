<?php

namespace App\Controller\Public;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageProductController extends AbstractController
{
    #[Route('/page', name: 'app_page_product')]
    public function index( ProductRepository $productRepository): Response
    {
        
        return $this->render('page_product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }
    #[Route('/page/{id}', name: 'app_product')]
    public function show(Product $product): Response
    {
        return $this->render('page_product/show.html.twig', [
            'product' => $product,
        ]);
    }
    
}
