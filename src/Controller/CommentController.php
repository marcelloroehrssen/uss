<?php

namespace App\Controller;

use App\Entity\DowntimeComment;
use App\Repository\DowntimeCommentRepository;
use App\Repository\DowntimeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CommentController
 * @package App\Controller
 * @Route("/comment", name="comment_index")
 * @IsGranted("ROLE_ADMIN", statusCode=401)
 */
class CommentController extends AbstractController
{
    /**
     * @Route(methods={"POST"})
     */
    public function create(EntityManagerInterface $entityManager, DowntimeRepository $downtimeRepository, Request $request)
    {
        $downtimeId = $request->request->get('dtid');
        $text = $request->request->get('text');

        $comment = new DowntimeComment();
        $comment->setDowntime($downtimeRepository->find($downtimeId));
        $comment->setText($text);
        $comment->setAuthor($this->getUser());

        try {
            $entityManager->persist($comment);
            $entityManager->flush();
            $data = ['success' => true, 'errors' => null];
        } catch (\Exception $e) {
            $data = ['success' => false, 'errors' => $e->getMessage()];
        }

        return $this->json($data);
    }
}
