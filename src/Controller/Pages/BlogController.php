<?php

namespace App\Controller\Pages;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


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

    #[Route([
        'fr' => '/blog/{categorie}/{slug}',
        'en' => '/en/blog/{categorie}/{slug}',
        'es' => '/es/blog/{categorie}/{slug}',
    ], name: 'app_blog_articleDetails', methods: ['GET'])]
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

    #[Route([
        'fr' => '/blog/{slug}',
        'en' => '/en/blog/{slug}',
        'es' => '/es/blog/{slug}',
    ], name: 'app_blog_articlesByCategory', methods: ['GET'])]
    public function articlesByCategory(string $slug, PaginatorInterface $paginator, Request $request): Response
    {
        $locale = $request->getLocale();

        $article = $this->catRepo->findOneBy(['slug' => $slug, 'lang' => $locale])->getArticles();

        $articles = $paginator->paginate(
            $article,
            $request->query->getInt('page', 1),
            9
        );

        return $this->render('blog/articlesByCategory.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route([
        'fr' => '/blog',
        'en' => '/en/blog',
        'es' => '/es/blog',
    ], name: 'app_blog_index', methods: ['GET'])]
    public function index(PaginatorInterface $paginator, Request $request): Response
    {

        $locale = $request->getLocale();
        $article = $this->articleRepo->findBy(['lang' => $locale], ['createdAt' => 'DESC']);

        $articles = $paginator->paginate(
            $article,
            $request->query->getInt('page', 1),
            8
        );

        return $this->render('blog/list_all_articles.html.twig', [
            'articles' => $articles,
        ]);
    }
}