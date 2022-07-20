<?php

namespace App\Controller\Admin;

use App\Entity\Transporteur;
use App\Form\TransporteurType;
use App\Repository\TransporteurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/transporteur')]
class TransporteurController extends AbstractController
{
    #[Route('/', name: 'app_transporteur_index', methods: ['GET'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function index(TransporteurRepository $transporteurRepository): Response
    {
        return $this->render('transporteur/index.html.twig', [
            'transporteurs' => $transporteurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_transporteur_new', methods: ['GET', 'POST'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function new(Request $request, TransporteurRepository $transporteurRepository): Response
    {
        $transporteur = new Transporteur();
        $form = $this->createForm(TransporteurType::class, $transporteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transporteurRepository->add($transporteur, true);

            return $this->redirectToRoute('app_transporteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('transporteur/new.html.twig', [
            'transporteur' => $transporteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_transporteur_show', methods: ['GET'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function show(Transporteur $transporteur): Response
    {
        return $this->render('transporteur/show.html.twig', [
            'transporteur' => $transporteur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_transporteur_edit', methods: ['GET', 'POST'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function edit(Request $request, Transporteur $transporteur, TransporteurRepository $transporteurRepository): Response
    {
        $form = $this->createForm(TransporteurType::class, $transporteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transporteurRepository->add($transporteur, true);

            return $this->redirectToRoute('app_transporteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('transporteur/edit.html.twig', [
            'transporteur' => $transporteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_transporteur_delete', methods: ['POST'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function delete(Request $request, Transporteur $transporteur, TransporteurRepository $transporteurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transporteur->getId(), $request->request->get('_token'))) {
            $transporteurRepository->remove($transporteur, true);
        }

        return $this->redirectToRoute('app_transporteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
