<?php

namespace App\Controller\Public;

use App\Entity\Cut;
use App\Entity\Product;
use App\Entity\ProductCut;
use App\Form\ListeCutType;
use App\Entity\ProductColor;
use App\Repository\CutRepository;
use App\Repository\ProductRepository;
use App\Repository\ProductCutRepository;
use App\Repository\ProductColorRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#[Route('/eshop')]
class PageProductController extends AbstractController
{
    #[Route('/', name: 'app_page_product')]
    public function index( ProductRepository $productRepository): Response
    {
        
        return $this->render('page_product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_show_product')]
    public function show(Request $request,Product $product, CutRepository $cutRepository ,ProductColorRepository $productColorRepository): Response
    {
        //recupere le get color
        $idProductColor =  $request->query->get("productColor");
        $productColor = $productColorRepository->find($idProductColor);
        $productCut = new ProductCut;
        $form = $this->createForm(ListeCutType::class, $productCut );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        $idproductCut = $form->get('productCuts')->getData();
        
        return $this->redirectToRoute("cart_add",[
           
            'id'=>$idproductCut->getId(),           
        ], Response::HTTP_SEE_OTHER);
        }
        //recupérer les taille de product color
        // $cuts = $productColor->getProductCuts();
        // $allcuts = $cutRepository->findAll();
    
     
        return $this->renderForm('page_product/show.html.twig', [
            'product' => $product,
            'productColor'=>$productColor,
            // 'cuts'=>$cuts,
            // 'allcuts'=>$allcuts,
            'form' =>$form
        ]);
    }
    
}
