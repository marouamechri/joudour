<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Repository\UserRepository;
use App\Repository\AdresseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/compte')]
class CompteUserController extends AbstractController
{
    #[Route('/', name: 'app_compte_user')]
    public function index(Request $request, AdresseRepository $adresseRepository, UserInterface $userConect, UserRepository $userRepository): Response
    {

        $user = $userRepository->find($userConect);

        //ajouter une nouvelle adresse
        $adresse = new Adresse();

        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adresse->setUser($user);
            $adresseRepository->add($adresse, true);
        }

        $id = $request->query->get("id");
        if($id){
       $adresse = $adresseRepository->fin($id);
            $form = $this->createForm(AdresseType::class, $adresse);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $adresseRepository->add($adresse, true);
            }
        }
        $orders = $user->getOrders();
        $adresses = $user->getAdresses();
        return $this->renderForm('compte_user/index.html.twig', [
            'controller_name' => 'CompteUserController',
            'orders' => $orders,
            'adresses' => $adresses,
            'adresse'=>$adresse,
            'id'=> $adresse->getId(),
            'user' => $user,
            'form' => $form,
        ]);
    }
}
