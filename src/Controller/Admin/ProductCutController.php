<?php

namespace App\Controller\Admin;

use App\Entity\ProductCut;
use App\Form\ProductCutType;
use App\Repository\ProductCutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/product/cut')]
class ProductCutController extends AbstractController
{
    #[Route('/', name: 'app_product_cut_index', methods: ['GET'])]
    public function index(ProductCutRepository $productCutRepository): Response
    {
        return $this->render('product_cut/index.html.twig', [
            'product_cuts' => $productCutRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_product_cut_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProductCutRepository $productCutRepository): Response
    {
        $productCut = new ProductCut();
        $form = $this->createForm(ProductCutType::class, $productCut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productCutRepository->add($productCut, true);

            return $this->redirectToRoute('app_product_cut_index', [], Response::HTTP_SEE_OTHER);
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

            return $this->redirectToRoute('app_product_cut_index', [], Response::HTTP_SEE_OTHER);
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

        return $this->redirectToRoute('app_product_cut_index', [], Response::HTTP_SEE_OTHER);
    }
}
