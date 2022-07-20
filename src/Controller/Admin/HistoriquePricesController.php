<?php

namespace App\Controller\Admin;

use App\Entity\ProductCut;
use App\Entity\HistoriquePrices;
use App\Form\HistoriquePricesType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\HistoriquePricesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/product/cut/historique')]
#[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
class HistoriquePricesController extends AbstractController
{
    #[Route('/', name: 'app_historique_prices_index', methods: ['GET'])]
    public function index(HistoriquePricesRepository $historiquePricesRepository): Response
    {
        return $this->render('historique_prices/index.html.twig', [
            'historique_prices' => $historiquePricesRepository->findAll(),
            
        ]);
    }

    #[Route('/{id}/new', name: 'app_historique_prices_new', methods: ['GET', 'POST'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function new(Request $request, ProductCut $productCut, HistoriquePricesRepository $historiquePricesRepository): Response
    {
         //on récuper le id de url
        //  $id = $request->query->get("id");
         //on recuper le produit de cette id
        //  $idProductCut = $productCutRepository->find($id);
        $historiquePrice = new HistoriquePrices();
        $form = $this->createForm(HistoriquePricesType::class, $historiquePrice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $historiquePrice->setProductCut($productCut);
            $historiquePricesRepository->add($historiquePrice, true);

            return $this->redirectToRoute('app_product_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('historique_prices/new.html.twig', [
            'historique_price' => $historiquePrice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_historique_prices_show', methods: ['GET'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function show(HistoriquePrices $historiquePrice): Response
    {
        return $this->render('historique_prices/show.html.twig', [
            'historique_price' => $historiquePrice,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_historique_prices_edit', methods: ['GET', 'POST'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function edit(Request $request, HistoriquePrices $historiquePrice, HistoriquePricesRepository $historiquePricesRepository): Response
    {
        $form = $this->createForm(HistoriquePricesType::class, $historiquePrice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $historiquePricesRepository->add($historiquePrice, true);

            return $this->redirectToRoute('app_product_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('historique_prices/edit.html.twig', [
            'historique_price' => $historiquePrice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_historique_prices_delete', methods: ['POST'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function delete(Request $request, HistoriquePrices $historiquePrice, HistoriquePricesRepository $historiquePricesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$historiquePrice->getId(), $request->request->get('_token'))) {
            $historiquePricesRepository->remove($historiquePrice, true);
        }

        return $this->redirectToRoute('app_product_color_index', [], Response::HTTP_SEE_OTHER);
    }
}
