<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function userpage()
    {
       	return $this->render('user/user.html.twig', ['controller_name' => 'UserController', 'userid' => 'Test']);
        }
    /**
     * @Route("/user/u/{page}", name="custom")
     */
    public function custom()
    {
    return $this->render('user/watchlist.html.twig', ['controller_name' => 'UserController', ]);
	} 
}
