<?php

namespace App\Controller\Admin;

use App\Entity\ImagewebSite;
use App\Form\ImagewebSiteType;
use App\Repository\ImagewebSiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/imageweb')]
class ImagewebSiteController extends AbstractController
{
    #[Route('/', name: 'app_imageweb_site_index', methods: ['GET'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function index(ImagewebSiteRepository $imagewebSiteRepository): Response
    {
        return $this->render('imageweb_site/index.html.twig', [
            'imageweb_sites' => $imagewebSiteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_imageweb_site_new', methods: ['GET', 'POST'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function new(Request $request, ImagewebSiteRepository $imagewebSiteRepository): Response
    {
        $website = $imagewebSiteRepository->findAll();

        $imagewebSite = new ImagewebSite();
        $form = $this->createForm(ImagewebSiteType::class, $imagewebSite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($website as $line) {
                //on récupère les nom des images
               
                $tabImage = [
                    $line->getPoster(),
                    $line->getRobe1(), $line->getRobe2(), $line->getRobe3(), $line->getImgloca1(), $line->getImgloca2(), $line->getImgloca3(),
                    $line->getImgShop1(), $line->getImgShop2(), $line->getImgShop3()
                ];

                foreach ($tabImage as $image) {
                    //on supprime le fichier
                    unlink($this->getParameter('images_directory_website') . '/' . $image);
                } 
            
                $imagewebSiteRepository->remove($line, true);
            }
            //recuperer le image file 
            $poster = $form->get('poster')->getData();
            $imageRobe1 = $form->get('robe1')->getData();
            $imageRobe2 = $form->get('robe2')->getData();
            $imageRobe3 = $form->get('robe3')->getData();
            $imageShop1 = $form->get('imgShop1')->getData();
            $imageShop2 = $form->get('imgShop2')->getData();
            $imageShop3 = $form->get('imgShop3')->getData();
            $imageLoc1 = $form->get('imgloca1')->getData();
            $imageLoc2 = $form->get('imgloca2')->getData();
            $imageLoc3 = $form->get('imgloca3')->getData();
            //tableau d'image
            $images = [
                $poster, $imageRobe1, $imageRobe2, $imageRobe3, $imageShop1,
                $imageShop2, $imageShop3, $imageLoc1, $imageLoc2, $imageLoc3
            ];
            $fichiers = [];
            $i = 0;
            foreach ($images as $image) {
                //on génère un nouveau non du fichier 
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                $fichiers[] =  $fichier;
                //enregistre l'image dans le dossier
                $image->move(
                    $this->getParameter('images_directory_website'),
                    $fichier
                );

                //on stocke le nom de l'image dans table
                switch ($i) {
                    case 0:
                        $imagewebSite->setPoster($fichier);
                        break;
                    case 1:
                        $imagewebSite->setRobe1($fichier);
                        break;
                    case 2:
                        $imagewebSite->setRobe2($fichier);
                        break;
                    case 3:
                        $imagewebSite->setRobe3($fichier);
                        break;
                    case 4:
                        $imagewebSite->setImgShop1($fichier);
                        break;
                    case 5:
                        $imagewebSite->setImgShop2($fichier);
                        break;
                    case 6:
                        $imagewebSite->setImgShop3($fichier);
                        break;
                    case 7:
                        $imagewebSite->setImgloca1($fichier);
                        break;
                    case 8:
                        $imagewebSite->setImgloca2($fichier);
                        break;
                    case 9:
                        $imagewebSite->setImgloca3($fichier);
                        break;
                }
                $i++;
            }
            //enregistrer dans la BDD
            $imagewebSiteRepository->add($imagewebSite, true);

            return $this->redirectToRoute('app_imageweb_site_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('imageweb_site/new.html.twig', [
            'imageweb_site' => $imagewebSite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_imageweb_site_show', methods: ['GET'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function show(ImagewebSite $imagewebSite): Response
    {
        return $this->render('imageweb_site/show.html.twig', [
            'imageweb_site' => $imagewebSite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_imageweb_site_edit', methods: ['GET', 'POST'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function edit(Request $request, ImagewebSite $imagewebSite, ImagewebSiteRepository $imagewebSiteRepository): Response
    {
        $form = $this->createForm(ImagewebSiteType::class, $imagewebSite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imagewebSiteRepository->add($imagewebSite, true);

            return $this->redirectToRoute('app_imageweb_site_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('imageweb_site/edit.html.twig', [
            'imageweb_site' => $imagewebSite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_imageweb_site_delete', methods: ['POST'])]
    #[IsGranted(data: 'ROLE_USER', message: "Vous n'avez pas les autorisations nécessaires", statusCode: 403)]
    public function delete(Request $request, ImagewebSite $imagewebSite, ImagewebSiteRepository $imagewebSiteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $imagewebSite->getId(), $request->request->get('_token'))) {
            $imagewebSiteRepository->remove($imagewebSite, true);
        }

        return $this->redirectToRoute('app_imageweb_site_index', [], Response::HTTP_SEE_OTHER);
    }
}
