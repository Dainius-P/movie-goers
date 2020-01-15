<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserManagementController extends AbstractController
{
    /**
     * @Route("/user/signin", name="signin")
     */
    public function signin()
    {
        return $this->render('user_management/signin.html.twig');
    }

    /**
     * @Route("/user/signup", name="signup", methods={"GET"})
     */
    public function signup()
    {
        return $this->render('user_management/signup.html.twig');
    }

    /**
     * @Route("/user/logout", name="logout")
     */
    public function logout()
    {
        return $this->render('user_management/signin.html.twig');
    }
}

