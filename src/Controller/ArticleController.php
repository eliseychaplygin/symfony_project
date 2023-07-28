<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route("/", name: "homepage", methods: ["GET"])]
    public function homepage(EntityManagerInterface $em):Response
    {
        $repository = $em->getRepository(Article::class);
        $articles = $repository->findLatestPublished();

        return $this->render('articles/homepage.html.twig', [
            'articles' => $articles
        ]);
    }

    #[Route("/article/{slug}", name: "article_show", methods: ["GET"])]
    public function show(Article $article): Response
    {
        return $this->render('articles/show.html.twig', [
            'article' => $article
        ]);
    }
}