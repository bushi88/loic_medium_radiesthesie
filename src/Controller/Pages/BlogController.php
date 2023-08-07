<?php

namespace App\Controller\Pages;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/blog', name: 'app_blog_')]
class BlogController extends AbstractController
{
    private $categories;
    private $catRepo;
    private $articleRepo;
    private $translator;

    public function __construct(CategoryRepository $catRepo, ArticleRepository $articleRepo, TranslatorInterface $translator)
    {
        $this->catRepo = $catRepo;
        $this->articleRepo = $articleRepo;
        $this->translator = $translator;
    }

    private function getCategories()
    {
        if ($this->categories === null) {
            $this->categories = $this->catRepo->findAll();
        }

        return $this->categories;
    }

    public function menu(): Response
    {
        return $this->render('blog/menu.html.twig', [
            'categories' => $this->getCategories(),
        ]);
    }

    #[Route('/articlesByCategory/{slug}', name: 'articlesByCategory', methods: ['GET', 'POST'])]
    public function articlesByCategory(string $slug): Response
    {
        // On utilise le slug pour retrouver l'ID de la catégorie
        $category = $this->catRepo->findOneBy(['slug' => $slug]);

        // On vérifie si la catégorie existe avant de récupérer les articles
        if ($category) {
            $categoryId = $category->getId();

            // Récupérer les articles par catégorie en utilisant l'ID de catégorie
            $articlesByCategory = $this->articleRepo->findbyCategory($categoryId);
            // dump($articlesByCategory);

            return $this->render('blog/articlesByCategory.html.twig', [
                'articlesByCategory' => $articlesByCategory,
                'category' => $category,
            ]);
        } else {
            // traduction via controller
            $message = $this->translator->trans('cette catégorie n\'existe pas.');
            $this->addFlash('warning', $message);
            return $this->redirectToRoute('app_home');
        }
    }

    #[Route('/{slug}', name: 'articleDetails')]
    public function details(Article $article): Response
    {
        if (!$article) {
            // traduction via controller
            $message = $this->translator->trans('cette article n\'existe pas.');
            $this->addFlash('warning', $message);
            return $this->redirectToRoute('app_home');
        }

        // Récupérer l'ID de la catégorie de l'article en cours
        $categoryId = $article->getCategory()->getId();

        // Récupérer les derniers articles de la même catégorie (à l'exception de l'article en cours)
        $relatedArticles = $this->articleRepo->findRelatedArticles($categoryId, $article->getId(), 2);

        return $this->render('blog/articleDetails.html.twig', [
            'article' => $article,
            'relatedArticles' => $relatedArticles,
        ]);
    }
}