<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\Text;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use App\Form\UserType;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
    	$form = $this->createFormBuilder()
    	->add('username', TextType::class, [
            'attr' => ['class' => 'sign__input',
            'placeholder' => "Vartotojo Vardas"],
            'label' => false,            
        ])
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'The password fields must match.',
            'options' => ['attr' => ['class' => 'sign__input',
            'placeholder'=>"Slaptažodis"]],
            'required' => true,
            'first_options'  => ['label' => ' '],
            'second_options' => ['label' => ' '], 
        ])
        ->add('email', EmailType::class, [
            'attr' => ['class' => 'sign__input',
            'placeholder' => "E. paštas"],
            'label' => false,
        ])

        ->add('register', SubmitType::class, [
            'attr' => [
                'class' => 'sign__btn'
                ]
        ])
        ->getForm()
        ;
        
        $form ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();


            $user = new User();
            $user -> setUsername($data['username']);
            $user -> setPassword(
                $passwordEncoder->encodePassword($user, $data['password'])
            );
            $user -> setEmail($data['email']);
            $user -> setImage('\img\profilePics\sun.png');
            $user -> setSecurityQuestion('Tuscia');
            $user -> setSecurityAnswer('Tuscia');
            $user -> setPhone('');
            $user -> setWatchListSize('0');
            $user -> setDescription('');
            $user -> setMoviesSeenCount('0');
            $user -> setComentCount('0');
            $user -> setRatingCount('0');
            
            //dump($user);
            $em = $this->getDoctrine()->getManager();

            $em ->persist($user);
            $em->flush();
            return $this->redirectToRoute('index');
        }

        return $this->render('registration/index.html.twig', [
             'reg_form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/reg", name="reg")
     */
    public function regist(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
    	$form = $this->createFormBuilder()
    	->add('username', TextType::class, [
            'attr' => ['class' => 'sign__input',
            'placeholder' => "Vartotojo Vardas"],
            'label' => false,            
        ])
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'The password fields must match.',
            'options' => ['attr' => ['class' => 'sign__input',
            'placeholder'=>"Slaptažodis"]],
            'required' => true,
            'first_options'  => ['label' => ' '],
            'second_options' => ['label' => ' '], 
        ])
        ->add('email', EmailType::class, [
            'attr' => ['class' => 'sign__input',
            'placeholder' => "E. paštas"],
            'label' => false,
        ])
        ->add('register', SubmitType::class, [
            'attr' => [
                'class' => 'sign__btn'
                ]
        ])
        ->getForm()
        ;
        
        $form ->handleRequest($request);
        if($form->isSubmitted()){
            $data = $form->getData();
            $user = new User();
            $user -> setUsername($data['username']);
            $user -> setPassword(
                $passwordEncoder->encodePassword($user, $data['password'])
            );
            $user -> setEmail($data['email']);
            $user -> setImage('Tuscia');
            $user -> setSecurityQuestion('Tuscia');
            $user -> setSecurityAnswer('Tuscia');
            $user -> setPhone('Tuscia');
            $user -> setWatchListSize('0');
            $user -> setDescription('Tuscia');
            $user -> setMoviesSeenCount('0');
            $user -> setComentCount('0');
            $user -> setRatingCount('0');
            
            dump($user);
            $em = $this->getDoctrine()->getManager();
            $em ->persist($user);
            $em->flush();
            return $this->redirectToRoute('index');
        }
        return $this->render('registration/signup.html.twig', [
             'reg_form' => $form->createView()
        ]);
    }
    
}
