<?php

namespace App\Controller\Pages;

use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Service\SendMailService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    private $email;

    public function __construct(SendMailService $email)
    {
        $this->email = $email;
    }

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // envoi de l'email
            $this->email->sendEmailByForm($form, 'contact');

            $this->addFlash('success', 'votre message a bien été envoyé.');
            return $this->redirectToRoute('app_home');
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('danger', 'Le formulaire contient une ou plusieurs erreurs et n\'a pas pu être envoyé. Veuillez corriger et réessayer svp ');
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}