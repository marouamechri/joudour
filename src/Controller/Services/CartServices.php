<?php
namespace App\Services;

use App\Repository\ProductCutRepository;
use  Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartServices{
    private $tva = 0.2;
    //ajouter un article dans le panier
    public function addToCart($id,SessionInterface $session,ProductCutRepository $productCutRepository){
       
         //recupérer la session cart
         $cart = $this->getCart($session);
         
        if(isset($cart[$id])){
            //produit est déjà dans le panier
            $cart[$id]++;
        }else{
            // le produit n'est pas dans le panier
            $cart[$id] = 1;
        }
        //modifier la session cart
        $this->updateCart($cart,$session,$productCutRepository);
    
    }

    //supprimer un article dans le panier
    public function deleteFromCart($id,SessionInterface $session,ProductCutRepository $productCutRepository){
        $cart = $this->getCart($session);
        //produit est dans le panier
        if(isset($cart[$id])){
            //quantity de produit supérieur à 1
            if($cart[$id] > 1){
                $cart[$id]--;
            }else{
                unset($cart[$id]);
            }
            $this->updateCart($cart,$session,$productCutRepository);
        }
    }

    //supprimer tout un article du panier
    public function deleteAllToCart($id,SessionInterface $session,ProductCutRepository $productCutRepository){
        $cart = $this->getCart($session);
        //produit est dans le panier
        if(isset($cart[$id])){
            //tous supprimer
            unset($cart[$id]);
            $this->updateCart($cart,$session,$productCutRepository);
        }
    }

    // public function deleteCart($cart,SessionInterface $session,ProductCutRepository $productCutRepository){
    //     $this->updateCart($cart, $session, $productCutRepository);
    // }
    //mettre a jour le panier
    public function updateCart($cart,SessionInterface $session,ProductCutRepository $productCutRepository){
        $session->set('cart', $cart);
        $session->set('cartData', $this->getFullCart($session, $productCutRepository));
    }
    //lire un panier
    public function getCart(SessionInterface $session){
        return $session->get('cart',[]);
    }
   
    /**
     * creation d'un fonction qui crée un objet tableau dans lequel sont disponible les données du produit
     * la quantité et ajout tax afin de l'envoyer vers le template panier.
     */
    public function getFullCart(SessionInterface $session, ProductCutRepository $productCutRepository){
        $cart = $this->getCart($session);
        $fullCart = [];
        $quantity_cart = 0;
        $subTotal = 0;
        
        foreach ($cart as $id => $quantity) {
            //recuperer le product cut
            $product = $productCutRepository->find($id);
            //recuperer le product color
            $productColor = $product->getProductColor();
            //recuperer le product parent
            $parent = $productColor->getProduct();
            if($product){
                //produit récupéré avec succès première clé products objet fullcart 
                $fullCart['products'][] = [
                    "quantity" => $quantity,
                    "product" => $product,
                    "productColor" => $productColor,
                    "parent" => $parent
                ];
                $quantity_cart += $quantity;
                $subTotal += $quantity * $parent->getAmountHTVA();
            }else{
                //identifiant incorrect
                $this->deleteFromCart($id,$session, $productCutRepository);
            }
        }
        //deuxième clé data dans l'objet fullcart
        $fullCart['data'] = [
            "quantity_cart" => $quantity_cart,
            "subTotalHT" => $subTotal,
            "Taxe" => round($subTotal*$this->tva,2),
            "subTotalTTC" => round(($subTotal + ($subTotal*$this->tva)),2)
        ];
        return $fullCart;
    }

}