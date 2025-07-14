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
    public function index(ProductRepository $productRepository,ProductCutRepository $productCutRepository, Request $request): Response
    {
        //gérer l'affichage des produis
        (string)$type = $request->query->get("type");
        (string)$genre =  $request->query->get("genre");
        (string)$collection =  $request->query->get("new");
        //(string)$orderPrice = $request->query->get("order");

        if ($type && $genre) {
            $products = $productRepository->FindProductType($type, $genre);
        } elseif ($collection) {
            $products = $productRepository->FindNewCollection();
            dd($products);
        } else {
            $products =  $productRepository->FindAllActive();
        }
        //mise ajour des productCut 
        //si le stoks supérieur à 0 le taille est active
        //sinon le taille est désactive
        foreach ($products as $product) {
            $productColors =$product->getProductColors();
            foreach ($productColors as $productColor) {
                $productCuts= $productColor->getProductCuts();
                foreach ($productCuts as $productCut) {
                    $stock  = $productCut->getStock();
                    if($stock->getNbrProduct()>0){
                        $productCut->setActive(true);
                    }else {
                       $productCut->setActive(false) ;
                    }
                     //enregistrer les données de product_cut dans BDD
                    $productCutRepository->add($productCut, true);
                }
            }
            
        }
        return $this->render('page_product/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/{id}', name: 'app_show_product')]
    public function show(Request $request, Product $product,
     ProductColorRepository $productColorRepository): Response
    {
        //recupere le get color
        $ProductColor =  $request->query->get("productColor");
        $productColor = $productColorRepository->find($ProductColor);
        $form = $this->createForm(ListeCutType::class, null, ['productColor' => $productColor]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $idproductCut = $form->get('productCuts')->getData();

            if ($idproductCut=="") {
                $this->addFlash('error', 'Vous n\'avez pas choisie la taille');

                return $this->redirectToRoute('app_show_product',[
                   'id'=>$product->getId(),
                   'productColor'=>$ProductColor
                ]);
            }else{
            

            return $this->redirectToRoute("cart_add", [

                'id' => $idproductCut->getId(),
            ], Response::HTTP_SEE_OTHER);
        }}

            return $this->renderForm('page_product/show.html.twig', [
                'product' => $product,
                'productColor' => $productColor,
                'form' => $form
            ]);
        
    }
}
