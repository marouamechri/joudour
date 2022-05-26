<?php

namespace App\Controller\Admin;

use App\Entity\HistoriquePrices;
use App\Entity\ProductCut;
use App\Entity\Stock;
use App\Form\ProductCutType;
use App\Repository\CutRepository;
use App\Repository\HistoriquePricesRepository;
use App\Repository\ProductColorRepository;
use App\Repository\ProductCutRepository;
use App\Repository\ProductRepository;
use App\Repository\StockRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/product/cut')]
class ProductCutController extends AbstractController
{
    #[Route('/', name: 'app_product_cut_index', methods: ['GET'])]
    public function index(ProductCutRepository $productCutRepository, ProductRepository $productRepository): Response
    {
        return $this->render('product_cut/index.html.twig', [
            'product_cuts' => $productCutRepository->findAll(),
            'products'=>$productRepository->findAll()
        ]);
    }

    #[Route('/new', name: 'app_product_cut_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProductCutRepository $productCutRepository, ProductColorRepository $productColorRepository, HistoriquePricesRepository $historiquePricesRepository): Response
    {
        //recuperation  le id de url
        $id = $request->query->get("id");
        //recuperation le produit de cette id
        $idProduct= $productColorRepository->find($id);

        //cretion d'un nouveau variable type ProductCut
        $productCut = new ProductCut();
         //creation un variable type Stock
        $stock = new Stock;
        //creation de variable de type HistoriquePrices
        $histpPrices = new HistoriquePrices;

        $form = $this->createForm(ProductCutType::class, $productCut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //recuperer de données stock 
            $min = $form->get('min')->getData();
            $max = $form->get('max')->getData();
            $nbProd = $form->get('nbrProd')->getData();
            //enregistrer les données de stock dans BDD
            $stock->setStockMin($min);
            $stock->setStockMax($max);
            $stock->setNbrProduct($nbProd);
            $productCut->setStock($stock);
            
            //recuperer les données de Historique de prix
            $start = $form->get('startDatePricesSaleHTVA')->getData();
            $end = $form->get('endDatePricesSaleHTVA')->getData();
            $amount = $form->get('amountHTVA')->getData();
            //enregistrer les données de stock dans BDD
            $histpPrices->setStartDatePricesSaleHTVA($start);
            $histpPrices->setEndDatePricesSaleHTVA($end);
            $histpPrices->setAmountHTVA($amount);
            $historiquePricesRepository->add($histpPrices);
            $productCut->addHistoriquePrice($histpPrices);

            
            //enregistrer les données de product_cut dans BDD
            $productCut->setProductColor($idProduct);
           $productCutRepository->add($productCut, true);

            return $this->redirectToRoute('app_product_color_index', [], Response::HTTP_SEE_OTHER);
        }
        
        
        return $this->renderForm('product_cut/new.html.twig', [
            'product_cut' => $productCut,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_cut_show', methods: ['GET'])]
    public function show(ProductCut $productCut): Response
    {
        return $this->render('product_cut/show.html.twig', [
            'product_cut' => $productCut,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_product_cut_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductCut $productCut, ProductCutRepository $productCutRepository): Response
    {
        $form = $this->createForm(ProductCutType::class, $productCut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productCutRepository->add($productCut, true);

            return $this->redirectToRoute('app_product_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product_cut/edit.html.twig', [
            'product_cut' => $productCut,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_cut_delete', methods: ['POST'])]
    public function delete(Request $request, ProductCut $productCut, ProductCutRepository $productCutRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productCut->getId(), $request->request->get('_token'))) {
            $productCutRepository->remove($productCut, true);
        }

        return $this->redirectToRoute('app_product_color_index', [], Response::HTTP_SEE_OTHER);
    }
}
