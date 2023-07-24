<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ArticleLikeController extends AbstractController
{
    #[Route("/articles/{slug}/like/{type<like|dislike>}", name: "article_like", methods: ["POST"])]
    public function like(
        Article $article,
        $type,
        LoggerInterface $logger,
        EntityManagerInterface $em
    ):JsonResponse
    {
        if($type == 'like') {
            $article->like();
            $logger->info('Лайк');
        } else {
            $article->dislike();
            $logger->info('Дизлайк');
        }

        $em->flush();

        return $this->json(['likes' => $article->getLikeCount()]);
    }
}