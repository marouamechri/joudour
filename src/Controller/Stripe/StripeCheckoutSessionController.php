<?php
namespace App\Controller\Stripe;

use Stripe\Stripe;
use App\Entity\Cart;
use App\Entity\Order;
use Stripe\Checkout\Session;
use App\Services\OrderServices;
use Doctrine\ORM\EntityManager;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StripeCheckoutSessionController extends AbstractController
{
    #[Route('/create-checkout-session/{reference}', name: 'app_stripe_checkout_session')]
    public function index(?Cart $cart, OrderServices $orderService,
    EntityManagerInterface $manager): Response
    {   
        $DOMAIN ="http://localhost:8000";
        $user = $this->getUser();
        //s'il n'y a pas de panier rederction vert acceuil
        if(!$cart){
          return $this->redirectToRoute('home');
        }
       $order = $orderService->createOrder($cart);
       Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);
        
       $checkout_session = Session::create([
        'customer_email' => $user->getUserIdentifier(),
        "payment_method_types" => ['card'],
        'line_items' => $orderService->getLineItems($cart),
        'mode' => 'payment',
        'success_url' => $DOMAIN.'/stripesuccesspayment/{CHECKOUT_SESSION_ID}',
        'cancel_url' => $DOMAIN.'/stripecancelpayment/{CHECKOUT_SESSION_ID}',
    ]);
    //StripeCheckoutSessionId et le clé qui transmise par stripe
    //il nous permet d'identifier la commande
    $order->setStripeCheckoutSessionId($checkout_session->id);
    $manager->flush();
    //une fois que valider il vous envoi dans une de page success ou cancel avec le clé checkout_session
    return 
    $this->json(['id' => $checkout_session->id]);
    }
}
