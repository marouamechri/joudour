<?php

namespace App\Services;

use App\Entity\Cart;
use App\Entity\Order;
use App\Entity\ProductCut;
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

    // public function createOrder($cart)
    // {

    //     $order = new Orders();//remplissage  table orders
    //     $order->setReference($cart->getReference())
    //     ->setFullname($cart->getFullName())
    //         ->setTransportName($cart->getTransportName())
    //         ->setTransportPrice($cart->getTransportPrice())
    //         ->setLivraisonAdresse($cart->getLivraisonAdresse())
    //         ->setQuantity($cart->getQuantity())
    //         ->setSubTotalHT($cart->getSubTotalHT())
    //         ->setTaxe($cart->getTaxe())
    //         ->setSubTotalTTC($cart->getSubTotalTTC())
    //         ->setUser($cart->getUser());
    //     $this->manager->persist($order);

    //     $products = $cart->getCartLines()->getValues();

    //     foreach ($products as $cart_product) {
    //         $orderDetails = new OrderDetails();//remplissage table orderDetails
    //         $orderDetails->setProductName($cart_product->getProductName())
    //                      ->setProductPrice($cart_product->getProductPrice())
    //                      ->setProductQuantity($cart_product->getProductQuantity())
    //                      ->setSubtotalHt($cart_product->getSubTotalHt())
    //                      ->setTaxe($cart_product->getTaxe())
    //                      ->setSubTotalTtc($cart_product->getSubTotalTtc())
    //                      ->setLienOrder($order);

    //         $this->manager->persist($orderDetails);
    //     }

    //     $this->manager->flush();

    //     return $order;
    // }
    public function saveCart($data, $user)
    {
        /*$data est un tableau
           [
            'products' => ['quantity', 'product'],//tous les produits du panier
            'data' => [],//sous-total, taxe, totalTTC
            'checkout' => [
                'address' => objet,
                'transporteurs' => objet,
                'informations' => sdfsfn
            ]
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
            ->setSubTotalTTC($data['data']['subTotalTTC'] + $transport->getPricesTransport() / 100)
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
                ->setSubToltalProductTTC(round($subtotal * 0.2), 2);

            $this->manager->persist($cartLine);
            $cart_lines_array[] = $cartLine;
        }
        $this->manager->flush();

        return $reference;
    }
    public function getLineItems($cart)
    {
        $cartDetails = $cart->getCartLines();
        $transportName = $cart->getTransportName();
        $transportPrice = $cart->getTransportPrice();
        $taxe = $cart->getTaxe();
        $line_items = [];
        foreach ($cartDetails as $details) {
            //$produit = $this->repoProduct->findOneByName($details->getProductName());//ne fonctionne pas

            $line_items[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $details->getProductPrice(),
                    'product_data' => [
                        'name' => $details->getProductName(),
                    ],
                ],
                'quantity' =>  $details->getProductQuantity(),
            ];
        }
        //transport
        $line_items[] = [
            'price_data' => [
                'currency' => 'eur',
                'unit_amount' => $transportPrice,
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
                'unit_amount' => $taxe,
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
