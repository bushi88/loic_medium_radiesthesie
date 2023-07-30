<?php

namespace App\Controller\Pages;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/blog', name: 'app_blog_')]
class BlogController extends AbstractController
{
    private $catRepo;
    private $categories;

    public function __construct(CategoryRepository $catRepo)
    {
        $this->catRepo = $catRepo;
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
    public function productsByCategory(ArticleRepository $articleRepo, $categoryId = null): Response
    {
        $articlesByCategory = $articleRepo->findbyCategory($categoryId);
        dd($articlesByCategory);

        return $this->render('blog/articlesByCategory.html.twig', [
            'productsByCategory' => $articlesByCategory,
        ]);
    }
}