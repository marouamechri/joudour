<?php

namespace App\Controller\Cart;

use App\Services\CartServices;
use App\Repository\ProductCutRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    private $cartServices;
    //une fonction __construct qui appelle le fichier Services
    public function __construct(CartServices $cartServices)
    {
        $this->cartServices = $cartServices;
    }

    /**
     * fonction qui appelle la fonction getFullCart
     *
     * @return Response
     */
    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session,ProductCutRepository $productCutRepository): Response
    {
        //recuperer le contenu du panier
        $cart = $this->cartServices->getFullCart($session,$productCutRepository);
 
        if (!isset($cart['products'])){
            return $this->redirectToRoute("home");
        }

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'cart'=> $cart,
        ]);
    }

    //ajouter dans le panier
    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function addToCart($id,SessionInterface $session,ProductCutRepository $productCutRepository): Response{
    
        $this->cartServices->addToCart($id, $session, $productCutRepository);

        return $this->redirectToRoute("app_cart");
    }

    //supprimer un produit
    #[Route('/cart/delete/{id}', name: 'cart_Delete')]
    public function deleteToCart($id,SessionInterface $session,ProductCutRepository $productCutRepository): Response{
    
        $this->cartServices->deleteFromCart($id,$session,$productCutRepository);

        return $this->redirectToRoute("app_cart");
    }

    //supprimer tous le penier
    #[Route('/cart/deleteAll/{id}', name: 'cart_Delete_All')]
    public function deleteAllCart($id,SessionInterface $session,ProductCutRepository $productCutRepository): Response{
    
        $this->cartServices->deleteAllToCart($id,$session,$productCutRepository);

        return $this->redirectToRoute("app_cart");
    }
}
