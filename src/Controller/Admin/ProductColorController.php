<?php

namespace App\Controller\Admin;

use App\Entity\Picture;
use App\Entity\ProductColor;
use App\Form\ProductColorType;
use App\Repository\ProductColorRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/product/color')]
class ProductColorController extends AbstractController
{
    #[Route('/', name: 'app_product_color_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product_color/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_product_color_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProductColorRepository $productColorRepository, ProductRepository $productRepository): Response
    {
        //on récuper le id de url
        $id = $request->query->get("id");
        //on recuper le produit de cette id
        $idProduct= $productRepository->find($id);
        $productColor = new ProductColor();
        $form = $this->createForm(ProductColorType::class, $productColor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //on recupère les image transmises
            $images = $form->get('images')->getData();
            
            //on boucle sur les image
            foreach ($images as $image) {
                //on génère un nouveau non du fichier 
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();
                //on copie le fichier dans le dossier img/upload
                $image->move(
                    $this->getParameter('images_directory_product'),
                    $fichier
                );

                //on stocke le nom de l'image dans BDD
                $img = new Picture();
                //on cree une image dans mon table Picture
                $img->setPictureName($fichier);
                //$img->setProductColor($productColor);
                //on rajoute l'image à mon bien
                $productColor->addPicture($img);
                //dd($img);
                $productColor->setProduct($idProduct);
            }


            // $entityManager = $manager->getManager();
            // $entityManager->persist($productColor);
            $productColorRepository->add($productColor, true);

            return $this->redirectToRoute('app_product_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product_color/new.html.twig', [
            'product_color' => $productColor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_color_show', methods: ['GET'])]
    public function show(ProductColor $productColor): Response
    {
        return $this->render('product_color/show.html.twig', [
            'product_color' => $productColor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_product_color_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductColor $productColor, ProductColorRepository $productColorRepository): Response
    {
        $form = $this->createForm(ProductColorType::class, $productColor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productColorRepository->add($productColor, true);

            return $this->redirectToRoute('app_product_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product_color/edit.html.twig', [
            'product_color' => $productColor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_color_delete', methods: ['POST'])]
    public function delete(Request $request, ProductColor $productColor, ProductColorRepository $productColorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productColor->getId(), $request->request->get('_token'))) {
            $productColorRepository->remove($productColor, true);
        }

        return $this->redirectToRoute('app_product_color_index', [], Response::HTTP_SEE_OTHER);
    }
}
