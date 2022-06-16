<?php

namespace App\Controller\Stripe;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeCancelController extends AbstractController
{
    #[Route('/stripe/cancel/payment', name: 'app_stripe_stripe_cancel')]
    public function index(): Response
    {
        return $this->render('stripe/stripe_cancel/index.html.twig', [
            'controller_name' => 'StripeCancelController',
        ]);
    }
}
