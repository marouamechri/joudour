<?php

namespace App\Controller\Admin;

use App\Entity\Colors;
use App\Form\ColorsType;
use App\Repository\ColorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/color')]
class ColorController extends AbstractController
{
    #[Route('/', name: 'app_color_index', methods: ['GET'])]
    public function index(ColorRepository $colorRepository): Response
    {
        return $this->render('colors/index.html.twig', [
            'colors' => $colorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_color_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ColorRepository $colorRepository): Response
    {
        $color = new Colors();
        $form = $this->createForm(ColorsType::class, $color);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $colorRepository->add($color, true);

            return $this->redirectToRoute('app_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('colors/new.html.twig', [
            'color' => $color,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_color_show', methods: ['GET'])]
    public function show(Colors $color): Response
    {
        return $this->render('colors/show.html.twig', [
            'color' => $color,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_color_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Colors $color, ColorRepository $colorRepository): Response
    {
        $form = $this->createForm(ColorsType::class, $color);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $colorRepository->add($color, true);

            return $this->redirectToRoute('app_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('colors/edit.html.twig', [
            'color' => $color,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_color_delete', methods: ['POST'])]
    public function delete(Request $request, Colors $color, ColorRepository $colorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$color->getId(), $request->request->get('_token'))) {
            $colorRepository->remove($color, true);
        }

        return $this->redirectToRoute('app_color_index', [], Response::HTTP_SEE_OTHER);
    }
}
