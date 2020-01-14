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
    /**
     * @Route("/signin", name="signin")
     */
    public function signin()
    {
        return $this->render('user/signin.html.twig', ['controller_name' => 'UserController']);
        }
        /**
     * @Route("/signup", name="signup")
     */
    public function signup()
    {
        return $this->render('user/signup.html.twig', ['controller_name' => 'UserController']);
        }
}
