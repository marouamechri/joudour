<?php

namespace App\Services;

use App\Entity\Cart;
use App\Entity\Order;
use App\Entity\CartLine;
use App\Entity\OrderLine;
use App\Repository\ProductCutRepository;
use Doctrine\ORM\EntityManagerInterface;

class OrderServices
{
    private $manager;
    private $repoProductCut;

    public function __construct(EntityManagerInterface $manager, ProductCutRepository $repoProductCut)
    {
        $this->manager = $manager;
        $this->repoProductCut = $repoProductCut;
    }

    public function createOrder($cart)
    {

        $order = new Order();//remplissage  table orders
        $order->setReference($cart->getReference())
            ->setFullname($cart->getFullName())
            ->setEmail($cart->getEmail())
            ->setTransportName($cart->getTransportName())
            ->setTransportPrice($cart->getTransportPrice())
            ->setAdresseLivraison($cart->getAdresseLivraison())
            ->setQuantityPanier($cart->getQuantityPanier())
            ->setSubTotalHT($cart->getSubTotalHT())
            ->setTaxe($cart->getTaxe())
            ->setSubTotalTTC($cart->getSubTotalTTC())
            ->setUser($cart->getUser()) 
            ->setCreatAt(new \DateTime())
            ->setIsPaid(false)
            ->setMoreInformation($cart->getmoreInformation());

        $this->manager->persist($order);

        $products = $cart->getCartLines()->getValues();

        foreach ($products as $cart_line) {
            $orderLine = new OrderLine();//remplissage table orderDetails
            $orderLine->setProductName($cart_line->getProductName())
                         ->setProductPrice($cart_line->getProductPrice())
                         ->setProductQuantity($cart_line->getProductQuantity())
                         ->setSubTotalProductHt($cart_line->getSubTotalProductHt())
                         ->setTaxeProduct($cart_line->getTaxeProduct())
                         ->setSubToltalProductTTC($cart_line->getsubToltalProductTTC())
                         ->setIdorder($order);                      

            $this->manager->persist($orderLine);
        }

        $this->manager->flush();

        return $order;
    }
    public function saveCart($data, $user)
    {
        /*$data est un tableau
           [
            'products' => ['quantity', 'product'],//tous les produits du panier
            'data' => [],//sous-total, taxe, totalTTC
            'checkout' => ['address' ,'transporteurs','informations' ]
        ]*/
        $cart = new Cart(); //remplissage de la table cart
        $reference = $this->generateUuid();
        $address = $data['checkout']['adresse'];
        $transport = $data['checkout']['transporteur'];
        $informations = $data['checkout']['informations'];


        $cart->setReference($reference)
            ->setFullname($address->getFullName())
            ->setEmail($user->getEmail())
            ->setTransportName($transport->getNameTransport())
            ->setTransportPrice($transport->getPricesTransport())
            ->setAdresseLivraison($address)
            ->setCreatAt(new \DateTime())
            ->setQuantityPanier($data['data']['quantity_cart']) //voir dans CartServices.php
            ->setSubTotalHT($data['data']['subTotalHT'])
            ->setTaxe($data['data']['Taxe'])
            ->setSubTotalTTC($data['data']['subTotalTTC'] + $transport->getPricesTransport())
            ->setUser($user)
            ->setIsPaid(false);
        if ($informations) {
            $cart->setMoreInformation($informations);
        }


        $this->manager->persist($cart);

        //creation de l'objet cart lines
        $cart_lines_array = [];
        //dans session les clés voir dans CartServices : "quantity" => $quantity, "product" => $product, "parent" => $parent
        foreach ($data['products'] as $products) {
            $cartLine = new CartLine(); //remplissage de la table cart-lines
            $subtotal = $products['quantity'] * $products['parent']->getAmountHTVA();
            $cartLine->setCart($cart)
                ->setProductName($products['parent']->getNameProduct())
                ->setProductPrice($products['parent']->getAmountHTVA())
                ->setProductQuantity($products['quantity'])
                ->setSubTotalProductHt($subtotal)
                ->setTaxeProduct(round($subtotal * 0.2), 2)
                ->setSubToltalProductTTC($subtotal + round($subtotal * 0.2), 2);

            $this->manager->persist($cartLine);
            $cart_lines_array[] = $cartLine;
        }
        $this->manager->flush();

        return $reference;
    }
    public function getLineItems($cart)
    {
        $cartLines = $cart->getCartLines();
        $transportName = $cart->getTransportName();
        $transportPrice = $cart->getTransportPrice();
        $taxe = $cart->getTaxe();
        $line_items = [];
        foreach ($cartLines as $line) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $line->getProductPrice()*100,
                    'product_data' => [
                        'name' => $line->getProductName(),
                    ],
                ],
                'quantity' =>  $line->getProductQuantity(),
            ];
        }
        //transport
        $line_items[] = [
            'price_data' => [
                'currency' => 'eur',
                'unit_amount' => $transportPrice*100,
                'product_data' => [
                    'name' => 'Transport ( ' . $transportName . ' )',
                ],
            ],
            'quantity' =>  1,
        ];
        // Taxe
        $line_items[] = [
            'price_data' => [
                'currency' => 'eur',
                'unit_amount' => $taxe*100,
                'product_data' => [
                    'name' => 'TVA (20%)',
                ],
            ],
            'quantity' =>  1,
        ];
        return $line_items;
    }

    public function generateUuid()
    {
        // Initialise le générateur de nombres aléatoires Mersenne Twister
        mt_srand((float)microtime() * 100000);

        //strtoupper : Renvoie une chaîne en majuscules
        //uniqid : Génère un identifiant unique
        $charid = strtoupper(md5(uniqid(rand(), true)));

        //Générer une chaîne d'un octet à partir d'un nombre
        $hyphen = chr(45);

        //substr : Retourne un segment de chaîne
        $uuid = ""
            . substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12);

        return $uuid;
    }
}
