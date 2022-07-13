<?php

namespace App\Controller\Stripe;

use App\Entity\Order;
use App\Services\CartServices;
use App\Repository\OrderRepository;
use App\Repository\ProductCutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StripeSuccessController extends AbstractController
{
    #[Route("/stripesuccesspayment/{stripeSessionId}", name:"stripe_success_payment")]
    public function index(Request $request,OrderRepository $orderRepository,SessionInterface $session,ProductCutRepository $productCutRepository, CartServices $cartServices, EntityManagerInterface $manager): Response
    {
        //dd($session);
        $stripeSessionId= $request->get("stripeSessionId");
        //dd($stripeSessionId);
        $order= $orderRepository->findOneBy(["StripeCheckoutSessionId"=>$stripeSessionId]);
        //dd($order);
        $cart = $cartServices->getCart($session);
        // $cartServices->deleteCart($cart,$session, $productCutRepository);

        if(!$order->isIsPaid()){
            //commande est payée
            $order->setIsPaid(true);
            $manager->flush();

            $cartServices->deleteCart($cart,$session, $productCutRepository);
           
            
        }
        //déconnecter
        $session->invalidate();

        return $this->render('stripe/stripe_success/index.html.twig', [
            'controller_name' => 'StripeSuccessController',
            'order'=>$order
        ]);
    }
}
