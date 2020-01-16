<?php

namespace App\Controller;

use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class MovieController extends AbstractController
{
    /**
    *@Route("/filmu_sarasas",name="filmu_sarasas")
    */
    public function randmovies()
    {
        $cnt = 4;        
        $allmovies = $this->getDoctrine()->getRepository(Movie::class)->findAll();
        $totalcnt =count($allmovies);
        $randmovies = array(0);
        $newmovies;
        $currentdate = date("Y-m-d");
        
        // $interval = $startDate->diff($endDate);
        // echo (int)(($interval->days) / 7);
        //$date = date("Y-m-d", strtotime($date));
        $date1 = "17-09-2018"; 
        $date2 = "31-09-2018";
        $diff=0;
        $j = 0;
        for ($i=0; $i < $totalcnt; $i++) 
        { 

            $date = $allmovies[$i]->getIsleidimoData();
            $diff = $date;
            $diff = date("Y-m-d");
            //$diff = $date->format("Y-m-d");
            $currentdate = date("d-m-Y");
            //$diff = strtotime($currentdate) - strtotime($date); 
      
            // 1 day = 24 hours 
            // 24 * 60 * 60 = 86400 seconds 
            // $diff = abs(round($diff / 86400));
            // //$interval = $date->diff($currentdate);
            // //$interval = date_diff($date, $currentdate);
            // // $interval = (int)(($interval->days)/7);
            // if($diff <= 365)
            // {
            //     $newmovies[$j] = $allmovies[$i];
            //     $j++;
            // }
            //$diff = $date->format("d-m-Y");
        }
        //$currentdate = date("d-m-Y");
        // $diff = strtotime($date1) - strtotime($date2);
        // $diff = abs(round($diff / 86400));
        if($cnt < $totalcnt)
        {
            $randIndex = array_rand($allmovies, $cnt);
            $i=0;
            while($cnt > $i)
            {
                $randmovies[$i] = $allmovies[$randIndex[$i]];
                $i=$i+1;
            }
        }
        else
        {
            $randmovies = $allmovies;
        }
        if($j==0)
        {
            return $this->render('movie/movie_list.html.twig',['allmovies'=>$allmovies,'randmovies'=>$randmovies,]);
        }
        return $this->render('movie/movie_list.html.twig',['allmovies'=>$allmovies,'randmovies'=>$randmovies,'newmovies'=>$newmovies]);
    }



    /**
    *@Route("/filmas/redaguoti/{id}",name="edit_movie",methods={"GET","POST"})
    */
    public function edit(Request $request, $id)
    {
        $movie = new Movie();
        $movie = $this->getDoctrine()->getRepository(Movie::class)->find($id);

        $form = $this->createFormBuilder($movie)
        ->add('Pavadinimas',TextType::class,['attr'=>['class'=>'form-control']])
        ->add('Aprasymas',TextareaType::class,['required'=>false,'attr'=>['class'=>'form-control']])
        ->add('Isleidimo_data',DateType::class,['required'=>false,'attr'=>['class'=>'form-control']])
        ->add('Ivercio_vidurkis',TextType::class,['required'=>false,'attr'=>['class'=>'form-control']])
        ->add('Ivercio_kiekis',TextType::class,['required'=>false,'attr'=>['class'=>'form-control']])
        ->add('Trukme',TimeType::class,['required'=>false,'attr'=>['class'=>'form-control']])
        ->add('save',SubmitType::class,['label'=>'Redaguoti', 'attr' => ['class' => 'btn btn-primary mt-3']])
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('testmovielist');
        }
        return $this->render('movie/edit_movie.html.twig',['form'=> $form->createView()]);
    }


    /**
    *@Route("/filmu_redagavimas",name="testmovielist")
    */
    public function test_movielist()
    {
        $movies = $this->getDoctrine()->getRepository(Movie::class)->findAll();
        $m = $this->getDoctrine()->getRepository(Movie::class)->findAll();
        $id = 2;
        $cnt = count($movies);
        return $this->render('movie/testmovielist.html.twig',['movies'=>$movies,'m'=>$m[$id],'cnt'=>$cnt]);
    }

    /**
    *@Route("/movie/delete/{id}",name="movie_delete",methods={"DELETE"})
    */
    public function delete(Request $request, $id)
    {
        $movie = $this->getDoctrine()->getRepository(Movie::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($movie);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }

    /**
    *@Route("/moviedelete2/{id}",name="movie_delete2",methods={"DELETE","GET"})
    */
    public function delete2(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $movie = $entityManager->getRepository('App\Entity\Movie')->find($id);

        if (!$movie) {
            return $this->redirectToRoute('testmovielist');
        }

        $entityManager->remove($movie);
        $entityManager->flush();

        return $this->redirectToRoute('del');
        return $this->render('movieremoved.html.twig');
    }

    /**
    * @Route("/naikinimo_patvirtinimas",name="del")
    */
    public function naikinimo_patvirtinimas()
    {
        return new Response('<html><body>Filmas istrintas</body></html><a href="/test_movie_list">Go back</a>');
    }

    /**
    *@Route("/naujas/filmas/",name="naujasfilmas",methods={"GET","POST"})
    */
    public function new_movie2(Request $request)
    {
        $movie = new Movie();

        $form = $this->createFormBuilder($movie)
        ->add('Pavadinimas',TextType::class,['attr'=>['class'=>'form-control']])
        ->add('Aprasymas',TextareaType::class,['required'=>false,'attr'=>['class'=>'form-control']])
        ->add('Isleidimo_data',DateType::class,['required'=>false,'attr'=>['class'=>'form-control']])
        ->add('Ivercio_vidurkis',TextType::class,['required'=>false,'attr'=>['class'=>'form-control']])
        ->add('Ivercio_kiekis',TextType::class,['required'=>false,'attr'=>['class'=>'form-control']])
        ->add('Trukme',TimeType::class,['required'=>false,'attr'=>['class'=>'form-control']])
        ->add('save',SubmitType::class,['label'=>'Kurti', 'attr' => ['class' => 'btn btn-primary mt-3']])
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($movie);
            $entityManager->flush();
            return $this->redirectToRoute('patv');
        }
        return $this->render('movie/new_movie.html.twig',['form'=> $form->createView()]);
    }

    /**
    *@Route("/new_movie/new",name="new_movie")
    */
    public function new_movie(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $movie = new Movie();
        /*$form = $this->createFormBuilder($movie)
            ->add('Pavadinimas',TextType::class,
                ['attr'=>['class'=>'form-control']])
            ->add('save',SubmitType::class.['label'=>'Create','attr'=>['class'=>'btn btn-primary']])
            ->getForm();

            return $this->render('new_movie.html.twig',['form'=>$form->createView()]);*/
        

        $Pavadinimas = $request->request->get('Pavadinimas');
        $movie->setPavadinimas($Pavadinimas);

        //$Isleidimo_data = $request->request->get('Isleidimo_data');
        // $movie->setIsleidimoData($Isleidimo_data);

        //$Trukme = $request->request->get('Trukme');
        // $movie->setTrukme($Trukme);


        $entityManager->persist($movie);
        $entityManager->flush();

        return $this->redirectToRoute('movies',['id'=> $movie->getId()]);
    }

    /**
    * @Route("/sukurimo_patvirtinimas",name="patv")
    */
    public function sukurimo_patvirtinimas()
    {
        return new Response(
            '<html><body>Filmas sukurtas</body></html><a href="/test_movie_list">Go back</a>'
        );
    }
    /**
     * @Route("/filmai/{id}", name="movie_details")
       @Method({"GET"})
    */
    public function movie_details(int $id)
    {
        $movie = $this->getDoctrine()->getRepository(Movie::class)->find($id);
        //reikia nukreipti jei id neegzistuoja
        return $this->render('movie/movie_details.html.twig',['movie' => $movie]);
    }

    /**
     * @Route("/movie/{id}",name="show_movie")
       @Method({"GET"})
    */
    public function show_movie(int $id)
    {
        $movie = $this->getDoctrine()->getRepository(Movie::class)->find($id);
        return $this->render('movie/movie_show.html.twig',['movie' => $movie]);
    }

    /*
     @Route("/")
     @Method({"GET"})
    */
    public function details()
    {
        $movies = $this->getDoctrine()->getRepository(Movie::class)->findAll();
        // return $this->render('index/index.html.twig',
        //     ('movies' => $movies));
    }

    /**
     * @Route("/movies/{page}", name="movies")
     */
    public function movies(int $page = 1)
    {
        return $this->render('movie/movie_list.html.twig');
    }



}
