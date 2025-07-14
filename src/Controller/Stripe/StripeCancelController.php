<?php

namespace App\Controller\Stripe;

use App\Entity\Order;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StripeCancelController extends AbstractController
{
    #[Route('/stripecancelpayment/{stripeSessionId}', name: 'stripe_cancel_payment')]
    public function index(?Order $order): Response
    {
        if(!$order || $order->getUser() !== $this->getUser()){
            return $this->redirectToRoute("home");
        }
        return $this->render('stripe/stripe_cancel/index.html.twig', [
            'controller_name' => 'StripeCancelController',
            'order' => $order,
        ]);
    }
}
