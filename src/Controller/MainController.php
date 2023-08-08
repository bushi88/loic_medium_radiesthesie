<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Service\SendMailService;
use App\Repository\ArticleRepository;
use App\Repository\HomeSliderRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    public function __construct(
        private HomeSliderRepository $slideRepo,
        private ArticleRepository $articleRepo,
        private SendMailService $email,
        private TranslatorInterface $translator
    ) {
    }

    /**
     * Je met une route par defaut pour le francais
     * Je met mes local pour les autres langues
     */
    #[Route([
        'fr' => '/',
        'en' => '/en',
        'es' => '/es'
    ], name: 'app_home')]
    public function index(Request $request): Response
    {
        /**
         * Je vais mettre dans une variable $locale la langue de l'utilisateur
         */
        $locale = $request->getLocale();

        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // envoi de l'email
            $this->email->sendEmailByForm($form, 'contact');

            $message = $this->translator->trans('votre message a bien été envoyé.');
            $this->addFlash('success', $message);
            return $this->redirectToRoute('app_home');
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $message = $this->translator->trans('Le formulaire contient une ou plusieurs erreurs et n\'a pas pu être envoyé. Veuillez corriger et réessayer svp.');
            $this->addFlash('danger', $message);
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('main/index.html.twig', [
            'homeSliders' => $this->slideRepo->findBy(['isDisplayed' => true, 'lang' => $locale], ['createdAt' => 'DESC'], 4),
            'lastArticles' => $this->articleRepo->findBy(['lang' => $locale], ['id' => 'DESC'], 11),
            'contactForm' => $form->createView(),
        ]);
    }
}