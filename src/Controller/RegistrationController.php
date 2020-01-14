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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use App\Form\UserType;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request)
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
                $passwordEncoder->encodePassword($user,$data['password'])
            );
            $user -> setPassword();
            dump($user);
            $em = $this->getDoctrine()->getManager();

            $em ->persist($user);
            $em->flush();
        }

        return $this->render('registration/index.html.twig', [
             'form' => $form->createView()
        ]);
    }
    
    
    
}
