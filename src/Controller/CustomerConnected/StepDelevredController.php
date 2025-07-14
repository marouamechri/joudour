<?php

namespace App\Controller\CustomerConnected;

use App\Entity\Adresse;
use App\Form\StepsOrderType;
use App\Repository\AdresseRepository;
use App\Repository\ProductCutRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StepDelevredController extends AbstractController
{
    #[Route('/stepsorder', name: 'app_step_order', methods: ['GET', 'POST'])]
    public function index(SessionInterface $session,ProductCutRepository $productCutRepository,
     Request $request, AdresseRepository $adresseRepository , UserInterface $user): Response
    {
        //afficher mon panier
        $panier = $session->get("panier", []);
        $dataPanier = [];
        $total = 0;
        $i=0;
        foreach ($panier as $id => $quantite) {
            //on recuper le produitCut
            $productCut = $productCutRepository->find($id);
            $productColor = $productCut->getProductColor();
            $parent = $productColor->getProduct();
            
            $dataPanier[] = [
                "product" => $productCut,
                "quantite" => $quantite,
                "productColor" => $productColor,
                "parent" => $parent

            ];
            $total += $parent->getAmountHTVA() * $quantite + 4.5;
            $i++;
        }

        //gestion de l'adresse de livraison
        //si l'utilisateur n'a pas une adresse dans notre bdd alors il devrair saisire  une nouvelle adresse
        //sinon en l'envoi l'adresse enregistrer dans notre bdd
        $adresses= $adresseRepository->getAdressUser($user);
        //   if(empty($adresses)) 
        //   {
            $adresse = new Adresse();
            $form = $this->createForm(StepsOrderType::class, $adresse);
            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {
                $adresse->setUser($user);
                $adresseRepository->add($adresse, true);
                dd($adresse);
    
            }
        // }
        return $this->renderForm('steps_ordred/StepsOrdered.html.twig', [
            'items' => $dataPanier,
            'total' => $total,
            'nbProduct'=> $i,
            'adresse' => $adresse,
            'form' => $form,
            

        ]);
        
    }

}