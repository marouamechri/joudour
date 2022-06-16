<?php
namespace App\Controller\Stripe;

use App\Entity\Order;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

class StripeCheckoutSessionController extends AbstractController
{
    #[Route('/create-checkout-session/{reference}', name: 'app_stripe_checkout_session')]
    public function index(SessionInterface $session, Order $Order ,UserInterface $user,  EntityManager $manager): Response
    {
        $panier = $session->get("panier", []);
        $dataPanier = [];
        $total = 0;
        $i=0;
        $DOMAIN ="http://localhost:8000";
        if(!$panier){
            return $this->redirectToRoute('home');
        }
        $user = $this->getUser();
        return $this->render('stripe/stripe_checkout_session/index.html.twig', [
            'controller_name' => 'StripeCheckoutSessionController',
        ]);
    }
}
