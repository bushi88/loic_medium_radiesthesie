<?php

namespace App\Controller\Pages;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/blog', name: 'app_blog_')]
class BlogController extends AbstractController
{
    private $catRepo;
    private $categories;
    private $articleRepo;

    public function __construct(CategoryRepository $catRepo, ArticleRepository $articleRepo)
    {
        $this->catRepo = $catRepo;
        $this->articleRepo = $articleRepo;
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
    public function articlesByCategory($slug): Response
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
            $this->addFlash('warning', 'cette catégorie n\'existe pas.');
            return $this->redirectToRoute('app_home');
        }
    }

    #[Route('/{slug}', name: 'articleDetails')]
    public function details(Article $article, Request $request, ArticleRepository $articleRepo): Response
    {
        if (!$article) {
            $this->addFlash('warning', 'Cet article n\'existe pas.');
            return $this->redirectToRoute('app_home');
        }

        // Récupérer l'ID de la catégorie de l'article en cours
        $categoryId = $article->getCategory()->getId();

        // Récupérer les derniers articles de la même catégorie (à l'exception de l'article en cours)
        $relatedArticles = $articleRepo->findRelatedArticles($categoryId, $article->getId(), 2);

        return $this->render('blog/articleDetails.html.twig', [
            'article' => $article,
            'relatedArticles' => $relatedArticles,
        ]);
    }
}