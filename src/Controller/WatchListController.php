<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\User;
use App\Entity\WatchList;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Repository\UserRepository;
use App\Repository\WatchListRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;


class WatchListController extends AbstractController
{
    /**
     * @Route("/addwatchlist/{id}", name="addwatchlist")
     * Method({"GET", "SET"})
     * @return Response
     */
    public function addwatchlist($id, MovieRepository $movieRepository)
    {
        $watchList=new WatchList();
        $user = $this->getUser();        
        $movie = $movieRepository->find($id);
        $watchList ->setMovieID($movie->getId());
        $watchList ->setOwnerID($user->getId());
        $watchList ->setDate(new \DateTime());
        $em = $this->getDoctrine()->getManager();
        $em ->persist($watchList);
        $em->flush();
        return $this->redirectToRoute('user');
    } 
    /**
     * @Route("/removewatchlist", name="removewatchlist")
     */
    public function removewatchlist()
    {
    return $this->render('user/watchlist.html.twig', ['controller_name' => 'UserController', ]);
    } 
    /**
     * @Route("/user/{id}/watchlist", name="watchlist")
     */
    public function watchlist($id, WatchListRepository $watchListRepository, UserRepository $userRepository)
    {
        $user = $userRepository -> find($id);
        $watchlists = $this->getDoctrine()->getRepository(WatchList::class)->findAll();
    return $this->render('user/watchlist.html.twig', [
        'user' => $user, 'watchlists' => $watchlists
    ]);
    }
}
