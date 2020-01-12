<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route("/movies/{page}", name="movies")
     */
    public function movies(int $page = 1)
    {
        return $this->render('movie/movie_list.html.twig');
    }

    /**
     * @Route("/movies/d/{id}", name="movie_details")
    */
    public function movie_details(int $id){
    	return $this->render(
            'movie/movie_details.html.twig',
            ['movie' => 'labas']
        );
    }
}
