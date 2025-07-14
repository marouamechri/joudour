<?php

namespace App\Controller\Admin;

use App\Entity\Option;
use App\Form\OptionType;
use App\Repository\OptionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/option')]
class OptionController extends AbstractController
{
    #[Route('/', name: 'app_option_index', methods: ['GET'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function index(OptionRepository $optionRepository): Response
    {
        return $this->render('option/index.html.twig', [
            'options' => $optionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_option_new', methods: ['GET', 'POST'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function new(Request $request, OptionRepository $optionRepository): Response
    {
        $option = new Option();
        $form = $this->createForm(OptionType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $optionRepository->add($option, true);

            return $this->redirectToRoute('app_option_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('option/new.html.twig', [
            'option' => $option,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_option_show', methods: ['GET'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function show(Option $option): Response
    {
        return $this->render('option/show.html.twig', [
            'option' => $option,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_option_edit', methods: ['GET', 'POST'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function edit(Request $request, Option $option, OptionRepository $optionRepository): Response
    {
        $form = $this->createForm(OptionType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $optionRepository->add($option, true);

            return $this->redirectToRoute('app_option_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('option/edit.html.twig', [
            'option' => $option,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_option_delete', methods: ['POST'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function delete(Request $request, Option $option, OptionRepository $optionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$option->getId(), $request->request->get('_token'))) {
            $optionRepository->remove($option, true);
        }

        return $this->redirectToRoute('app_option_index', [], Response::HTTP_SEE_OTHER);
    }
}
