<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Entity\Comment;
use App\Entity\User;
use App\Entity\CommentReport;
use App\Entity\CommentRating;

class CommentController extends AbstractController
{
    /**
     * @Route("/comments/{obj_id}/{page}", name="comments", methods={"GET"})
     */
    public function comments(int $obj_id, int $page = 1)
    {
        $pageSize = 10;
        $repo = $this->getDoctrine()->getRepository(Comment::class);

        try{
            $offset = $pageSize * ($page - 1);
        } catch(\Exception $e){
            $offset = 0;
        }

        $comments = $repo->findBy(
            ['object_id' => $obj_id],
            [],
            $pageSize,
            $offset
        );

        $comments_count = $repo->findBy(['object_id' => $obj_id]);
        $comments_count = count($comments_count);

        return $this->render(
            'comment/comments.html.twig',
            ['comments' => $comments,
             'comments_count' => $comments_count
            ]
        );
    }

    /**
     * @Route("/comments/username/{id}", name="comment_username", methods={"GET"})
    */
    public function comment_username(int $id){
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->findOneBy([
            'id' => $id
        ]);

        return $this->render(
            'comment/comment_user.html.twig',
            ['user' => $user]
        );
    }

    /**
    * @Route("/comments/create", name="create_comment", methods={"POST"})
    */
    public function create_comment(Request $request, UserInterface $user){
        $entityManager = $this->getDoctrine()->getManager();

        $author_id = $user->getId();
        $object_id = $request->request->get('object_id');
        $comment_text = $request->request->get('comment');
        $current_timestamp = new \DateTime();

        if($comment_text != null){
            $comment = new Comment();
            $comment->setAuthorId($author_id);
            $comment->setTimestampCreated($current_timestamp);
            $comment->setTimestampUpdated($current_timestamp);
            $comment->setPositiveRating(0);
            $comment->setNegativeRating(0);
            $comment->setComment($comment_text);
            $comment->setObjectId($object_id);

            $entityManager->persist($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('movie_details', [
                'id' => $object_id
        ]);
    }

    /**
    * @Route("/comments/delete", name="delete_comment", methods={"POST"})
    */
    public function delete_comment(Request $request, UserInterface $user){
        $entityManager = $this->getDoctrine()->getManager();
        $repo = $this->getDoctrine()->getRepository(Comment::class);

        $author_id = $user->getId();
        $comment_id = intval($request->request->get('comment_id'));

        $comment = $repo->findOneBy([
            'author_id' => $author_id,
            'id' => $comment_id,
        ]);

        if($comment){
            $entityManager->remove($comment);
            $entityManager->flush();
        } else {
            throw $this->createNotFoundException('Komentaras nerastas');
        }

        return $this->redirectToRoute('movie_details', [
            'id' => $comment->getObjectId()
        ]);
    }

    /**
    * @Route("/comments/edit", name="edit_comment", methods={"PUT"})
    */
    public function edit_comment(Request $request, UserInterface $user){
        $entityManager = $this->getDoctrine()->getManager();
        $repo = $this->getDoctrine()->getRepository(Comment::class);

        $comment_id = $request->request->get('comment_id');
        $author_id = $user->getId();
        $current_timestamp = new \DateTime();

        $comment = $repo->find($comment_id);
        if (!$comment || $comment->getAuthorId() != $author_id) {
            throw $this->createNotFoundException('Komentaras nerastas');
        }

        $comment_text = $request->request->get('comment');

        $comment->setComment($comment_text);
        $comment->setTimestampUpdated($current_timestamp);
        $entityManager->flush();

        return $this->redirectToRoute('comments', [
            'obj_id' => $comment->getObjectId()
        ]);
    }

    /**
    * @Route("/comments/report", name="report_comment", methods={"POST"})
    */
    public function report_comment(Request $request, UserInterface $user){
        $entityManager = $this->getDoctrine()->getManager();
        $repo = $this->getDoctrine()->getRepository(CommentReport::class);

        $comment_id = $request->request->get('comment_id');
        $report_text = $request->request->get('report');
        $current_timestamp = new \DateTime();
        $author_id = $user->getId();

        $report = $repo->findOneBy([
            'author_id' => $author_id,
            'comment_id' => $comment_id
        ]);

        if($report){
            throw $this->createNotFoundException(
                'Negalima kurti dvieju reportu'
            );
        }

        $comment_report = new CommentReport();
        $comment_report->setCommentId($comment_id);
        $comment_report->setAuthorId($author_id);
        $comment_report->setReport($report_text);
        $comment_report->setTimestampCreated($current_timestamp);

        $entityManager->persist($comment_report);
        $entityManager->flush();

        return $this->redirectToRoute('comments', [
            'obj_id' => $comment_id
        ]);
    }


    /**
    * @Route("/comments/rate", name="rate_comment", methods={"POST"})
    */
    public function rate_comment(Request $request, UserInterface $user){
        $entityManager = $this->getDoctrine()->getManager();
        $repo = $this->getDoctrine()->getRepository(Comment::class);

        $comment_id = $request->request->get('comment_id');
        $rating = $request->request->get('rating');
        $movie_id = $request->request->get('movie_id');

        $comment = $repo->findOneBy([
            'id' => $comment_id
        ]);

        if($rating == 1){
            $pos_rating = $comment->getPositiveRating();
            $comment->setPositiveRating($pos_rating + 1);
        } else {
            $neg_rating = $comment->getNegativeRating();
            $comment->setNegativeRating($neg_rating + 1);
        }

        $entityManager->persist($comment);
        $entityManager->flush();

        return $this->redirectToRoute('movie_details', [
            'id' => $movie_id
        ]);
    }
}
