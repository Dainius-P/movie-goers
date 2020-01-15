<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Entity\WatchList;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function userpage()
    {
        $user = $this ->getUser();
       	return $this->render('user/user.html.twig', ['controller_name' => 'UserController', 'user' => $user ]);
        }
    /**
     * @Route("/user/{userid}", name="userpage")
     */
    public function userpageU(int $userid)
    {
    return $this->render('user/user.html.twig', ['controller_name' => 'UserController', ]);
	} 
    /**
     * @Route("/user/{page}/watchlist", name="watchlist")
     */
    public function watchlist()
    {
    return $this->render('user/watchlist.html.twig', ['controller_name' => 'UserController', ]);
    } 
    /**
     * @Route("/useredit", name="editUser")
     */
    public function EditUser()
    {
    return $this->render('user/editUser.html.twig', ['controller_name' => 'UserController', ]);
    } 
    
}
