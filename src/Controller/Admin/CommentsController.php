<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentsController extends AbstractController
{
    #[Route('/admin/comments', name: 'admin_comments')]
    public function index(Request $request): Response
    {

        $comments = [
            [
                'articleTitle' => 'Есть ли жизнь после девятой жизни?',
                'comment' => 'Hercle, mensa mirabilis!.',
                'createdAt' => new \DateTime('-1 hours'),
                'authorName' => 'Сметанка'
            ],
            [
                'articleTitle' => 'Когда в машинах поставят лоток?',
                'comment' => 'consiliums studere! ',
                'createdAt' => new \DateTime('-1 days'),
                'authorName' => 'Рыжий Бесстыжий'
            ],
            [
                'articleTitle' => 'Есть ли жизнь после девятой жизни?',
                'comment' => 'Sunt itineris tramitemes manifestum audax, pius peses. Vae, clemens coordinatae!',
                'createdAt' => new \DateTime('-11 days'),
                'authorName' => 'Барон Сосискин'
            ],
            [
                'articleTitle' => 'В погоне за красной точкой',
                'comment' => 'Heu, scutum! Cur caesium trabem? Est nobilis extum, cesaris. Brodiums potus in hamburgum!',
                'createdAt' => new \DateTime('-35 hours'),
                'authorName' => 'Сметанка'
            ],
        ];

        $q = $request->query->get('q');

        if ($q) {
            $comments = array_filter($comments, function ($comment) use ($q) {
                return stripos($comment['comment'], $q) !== false;
            });
        }

        return $this->render('admin/comments/index.html.twig', [
            'comments' => $comments,
        ]);
    }
}
