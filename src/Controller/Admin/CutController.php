<?php

namespace App\Controller\Admin;

use App\Entity\Cut;
use App\Form\CutType;
use App\Repository\CutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/cut')]
class CutController extends AbstractController
{
    #[Route('/', name: 'app_cut_index', methods: ['GET'])]
    public function index(CutRepository $cutRepository): Response
    {
        return $this->render('cut/index.html.twig', [
            'cuts' => $cutRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cut_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CutRepository $cutRepository): Response
    {
        $cut = new Cut();
        $form = $this->createForm(CutType::class, $cut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cutRepository->add($cut, true);

            return $this->redirectToRoute('app_cut_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cut/new.html.twig', [
            'cut' => $cut,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cut_show', methods: ['GET'])]
    public function show(Cut $cut): Response
    {
        return $this->render('cut/show.html.twig', [
            'cut' => $cut,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cut_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cut $cut, CutRepository $cutRepository): Response
    {
        $form = $this->createForm(CutType::class, $cut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cutRepository->add($cut, true);

            return $this->redirectToRoute('app_cut_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cut/edit.html.twig', [
            'cut' => $cut,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cut_delete', methods: ['POST'])]
    public function delete(Request $request, Cut $cut, CutRepository $cutRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cut->getId(), $request->request->get('_token'))) {
            $cutRepository->remove($cut, true);
        }

        return $this->redirectToRoute('app_cut_index', [], Response::HTTP_SEE_OTHER);
    }
}
