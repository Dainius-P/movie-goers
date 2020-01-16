<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\User;
use App\Entity\WatchList;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Repository\UserRepository;
use App\Repository\WatchListRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
     * @Route("/addwatchlist", name="addwatchlist")
     * @return Response
     */
    public function addwatchlist($id, MovieRepository $movieRepository)
    {
        $watchList=new WatchList();
        $user = $this->getUser();        
        $movie = $movieRepository->find($id);

        $watchList ->setMovieID($movie->getId());
        $watchList ->setOwnerID($user->getId());
        $em = $this->getDoctrine()->getManager();
        $em ->persist($watchList);
        $em->flush();
        return $this->redirectToRoute('user');
    } 
    /**
     * @Route("/user/{page}/watchlist", name="removewatchlist")
     */
    public function removewatchlist()
    {
    return $this->render('user/watchlist.html.twig', ['controller_name' => 'UserController', ]);
    } 
    /**
     * @Route("/user/{id}/watchlist", name="watchlist")
     */
    public function watchlist($id, WatchListRepository $watchListRepository)
    {
    return $this->render('user/watchlist.html.twig', ['controller_name' => 'UserController', ]);
    } 
    /**
     * @Route("/user/edit", name="editUser")
     * Method({"GET", "POST"})
     */
    public function EditUser(Request $request)
    {
        $user = $this ->getUser();
        $form = $this ->createFormBuilder($user)
        ->add('birthday', DateType::class, [
            'attr' => ['class' => 'date'],            
            'label' => false,
            'required'=> false
        ])        
        ->add('email', EmailType::class, [
            'attr' => ['class' => 'sign__input'],
            'label' => false,
        ])
        ->add('phone', TextType::class, [
            'attr' => ['class' => 'sign__input',
            'placeholder' => "Tel. numeris"],
            'label' => false,
        ])
        ->add('description', TextType::class, [
            'attr' => ['class' => 'sign__input',
            'placeholder' => "Aprašymas"],
            'label' => false,
        ])
        ->add('attachment', FileType::class,[
            'mapped' => false,
            'label' => false,
        ])
        ->add("Saugoti", SubmitType::class, [
            'attr' => [
                'class' => 'sign__btn'
                ]
        ])
        ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            
            $file =$request->files->get('form')['attachment'];

            $em = $this->getDoctrine()->getManager();
            if ($file) {
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $uploads_dir = $this->getParameter('uploads_dir');
                $file->move(
                    $uploads_dir,
                    $filename        
                );
                $user -> setImage($filename);

            }
            $em -> flush();
            return $this->redirectToRoute('user');
        }
    
        return $this->render('user/editUser.html.twig', [ 
            'form' => $form->createView() 
            ]);
    } 
    /**
     * @Route("/user/{id}", name="userpage")
     * @return Response
     */
    public function userpageU(int $id, UserRepository $userRepository)
    {
        //$id = 17;
        $user = $userRepository->find($id);
        //dump($user, $id);
        return $this->render('user/user.html.twig', ['controller_name' => 'UserController', 'user' => $user ]);
	} 
}
