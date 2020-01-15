<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Entity\WatchList;
use App\Repository\UserRepository;

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
     * @Route("/user/{id}", name="userpage")
     * @return Response
     */
    public function userpageU(int $id, UserRepository $userRepository)
    {
        //$id = 17;
        $user = $userRepository->find($id);
        dump($user, $id);
        return $this->render('user/user.html.twig', ['controller_name' => 'UserController', 'user' => $user ]);
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
