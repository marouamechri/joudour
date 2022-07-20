<?php

namespace App\Controller\Stripe;

use App\Entity\Order;
use App\Services\CartServices;
use App\Repository\OrderRepository;
use App\Repository\ProductCutRepository;
use App\Repository\StockRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StripeSuccessController extends AbstractController
{
    #[Route("/stripesuccesspayment/{stripeSessionId}", name:"stripe_success_payment")]
    public function index(Request $request,StockRepository $stockRepository, OrderRepository $orderRepository,SessionInterface $session,ProductCutRepository $productCutRepository, CartServices $cartServices, EntityManagerInterface $manager): Response
    {
        //dd($session);
        $stripeSessionId= $request->get("stripeSessionId");
        //dd($stripeSessionId);
        $order= $orderRepository->findOneBy(["StripeCheckoutSessionId"=>$stripeSessionId]);
        //dd($order);
        $cart = $cartServices->getCart($session);
        
        //Mise à jour de stocks
        
        foreach ($cart as $id => $quantity) {
            //recuperer le product cut et modifier son stock
            $product = $productCutRepository->find($id);
            $stock = $product->getStock();
            $stockPrev = $stock->getNbrProduct();
            dump($stockPrev);
            $stockAct= $stockPrev - $quantity;
            //dd($stockAct);
            $stock->setNbrProduct($stockAct);
            $stockRepository->add($stock, true);
        }
       
        if(!$order->isIsPaid()){
            //commande est payée
            $order->setIsPaid(true);
            //dd($order);
            $manager->flush();

            //$cartServices->deleteCart($cart,$session, $productCutRepository);
           
            
        }
        //déconnecter
        $session->invalidate();

        return $this->render('stripe/stripe_success/index.html.twig', [
            'controller_name' => 'StripeSuccessController',
            'order'=>$order
        ]);
    }
}
