<?php

namespace App\Controller\Public;

use App\Entity\ProductCut;
use App\Entity\ProductColor;
use App\Repository\ProductRepository;
use App\Repository\ProductCutRepository;
use App\Repository\ProductColorRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/cart')]
class CartController extends AbstractController
{
    #[Route('/', name: 'cart_index')]
    public function index(SessionInterface $session, ProductCutRepository $productCutRepository): Response
    {
        $panier = $session->get("panier", []);
        //on fabrique les données

        $dataPanier = [];
        $total = 0;
        $i=0;
        foreach ($panier as $id => $quantite) {
            //on recuper le produitCut
            $productCut = $productCutRepository->find($id);
            $productColor = $productCut->getProductColor();
            $parent = $productColor->getProduct();
            
            $dataPanier[] = [
                "product" => $productCut,
                "quantite" => $quantite,
                "productColor" => $productColor,
                "parent" => $parent

            ];
            $total += $parent->getAmountHTVA() * $quantite + 4.5;
            $i++;
        }
        return $this->render('cart/index.html.twig', [
            'items' => $dataPanier,
            'total' => $total,
            'nbProduct'=>$i
            

        ]);
    }
    #[Route('/add/{id}', name: 'cart_add')]
    public function add(ProductCut $productCut, SessionInterface $session)
    {
        //on récupère le panier actuel
        $panier = $session->get("panier", []);
        //recuperer id color
        $id = $productCut->getId();

        //si j'ai le produit je l'incriment plus 1
        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            //je le criee
            $panier[$id] = 1;
        }
        //on sauvgarde dans la session
        $session->set("panier", $panier);
        return $this->redirectToRoute("cart_index", [
            'product' => $id,
        ], Response::HTTP_SEE_OTHER);
    }
    #[Route('/remove/{id}', name: 'cart_remove')]
    public function remove(ProductCut $productCut, SessionInterface $session)
    {
        //on récupère le panier actuel
        $panier = $session->get("panier", []);
        //recuperer id color
        $id = $productCut->getId();

        //si j'ai le produit je l'incriment plus 1
        if (!empty($panier[$id])) {

            if ($panier[$id] > 1) {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }
        //on sauvgarde dans la session
        $session->set("panier", $panier);
        return $this->redirectToRoute("cart_index");
    }
    #[Route('/delete/{id}', name: 'cart_delete')]
    public function delete(ProductCut $productCut, SessionInterface $session)
    {
        //on récupère le panier actuel
        $panier = $session->get("panier", []);
        //recuperer id color
        $id = $productCut->getId();

        //si j'ai le produit je l'incriment plus 1
        if (!empty($panier[$id])) {

            unset($panier[$id]);
            
        }
        //on sauvgarde dans la session
        $session->set("panier", $panier);
        return $this->redirectToRoute("cart_index");
    }
}
