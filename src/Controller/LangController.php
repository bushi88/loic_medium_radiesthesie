<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class LangController extends AbstractController
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    #[Route('/change-locale/{locale}', name: 'app_change_locale')]
    public function changeLocale($locale): Response
    {
        if (in_array($locale, $this->getParameter('app.locales'))) {
            $this->setLocale($locale);
        }

        return $this->redirectToRoute('app_home');
    }

    private function setLocale(string $locale): void
    {
        $request = $this->requestStack->getCurrentRequest();
        $request->getSession()->set('_locale', $locale);
    }
}