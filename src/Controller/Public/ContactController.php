<?php

namespace App\Controller\Public;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('Email')->getData();
            (string)$message = $form->get('message')->getData();
            $fullname = $form->get('fullName')->getData();;
         // generate a signed url and email it to the user
         $email = (new Email())
             ->from($email)
             ->to('joudour@joudour.com')
             ->subject('Contactez nous')
             ->html('<p>Nom et prenom :'.$fullname.'</p>
                 <p>'.$message.'</p>'
            );
        $mailer->send($email);
    }
        return $this->renderForm('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form'=>$form
        ]);
    }
}
