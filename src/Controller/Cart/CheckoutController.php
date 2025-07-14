<?php

namespace App\Controller\Cart;

use App\Form\CkeckoutType;
use App\Services\CartServices;
use App\Services\OrderServices;
use App\Repository\UserRepository;
use App\Repository\ProductCutRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CheckoutController extends AbstractController
{
    private $cartServices;
    public function __construct(CartServices $cartServices)
    {
        $this->cartServices = $cartServices;
    }

    #[Route('/checkout', name: 'app_checkout')]
    public function index(Request $request,SessionInterface $session,UserInterface $userConncet,
     ProductCutRepository $productCutRepository, UserRepository $userRepo): Response
    {
        $user = $userRepo->find($userConncet);
        $cart = $this->cartServices->getFullCart($session,$productCutRepository);
        //si le panier est vide on se derige vers l'acceuil
        if(!isset($cart['products'])){
            return $this->redirectToRoute("home");
        }
        //si il l'utilistaeur n'a pas d'adresse il se derige vers la creation d'un nouveau adresse
        if(!$user->getAdresses()->getValues()){
            $this->addFlash('checkout_message', 'Merci de renseigner une adresse de livraison avant de continuer !');
            return $this->redirectToRoute("adresse_new");
        }
       
        $form = $this->createForm(CkeckoutType::class, null, ['user'=>$user]);
        $form->handleRequest($request);
        //traitement du formulaire voir methode checkoutConfirm

        return $this->render('checkout/index.html.twig', [
            'cart'=>$cart,
            'checkout'=>$form->createView()
                ]);
    }

    #[Route('/checkout/confirm', name: 'checkoutConfirm')]
    public function confirm(Request $request, ProductCutRepository $productCutRepo, 
    UserRepository $userRepository, UserInterface $userConnect, CartServices $cartServices,
     SessionInterface $session, OrderServices $orderServices): Response
    {
        $user = $userRepository->find($userConnect) ;
        $cart = $cartServices->getFullCart($session, $productCutRepo);
        //si le panier est vide redirectToRoute panierge home
        if(!isset($cart['products'])){
            return $this->redirectToRoute("home");
        }
        //si l'utilistaeur n'a pas d'adresse redirectToRoute creationn d'un nouveau adresse
        if(!$user->getAdresses()->getValues()){
            $this->addFlash('checkout_message', 'Merci de renseigner une adresse de livraison avant de continuer !');
            return $this->redirectToRoute("adresse_new");
        }
        
        //recuperation des données saisie de la forme CheckoutType
        $form = $this->createForm(CkeckoutType::class, null, ['user'=>$user]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() || $this->session->get('checkout_data')) {
            //si la session checkout data existe on bascule tout les information dans data
            if($session->get('checkout_data')){
                $data = $session->get('checkout_data');
            } else {
            // sinon on recupére les information de la form on le met dans un objet data et ensuite 
                $data = $form->getData();
                //dd($data);
                //on crée dans la session le checkout data et l'injecte l'objet data
                $session->set('checkout_data',$data);
            }
            
            $adresse = $data['adresse'];
            $transport = $data['transporteur'];
            $information = $data['informations'];
            
             //save panier
             $cart['checkout'] = $data;
             //dd($cart);

            $reference = $orderServices->saveCart($cart,$user);
            return $this->render('checkout/confirm.html.twig', [
                'cart'=>$cart,
                'adresse' =>$adresse,
                'transporteur' =>$transport,
                'information' =>$information,
               'reference' =>$reference,
                'checkout'=>$form->createView()
            ]);
        }
        return $this->redirectToRoute('checkout');
    }

}
