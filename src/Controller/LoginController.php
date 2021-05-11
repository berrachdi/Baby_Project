<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(Request $request,EntityManagerInterface $em): Response
    {
      if($request->isMethod('POST'))
      {
      // Extract user data from request

          $username = $request->request->get('username');
          $password = $request->request->get('password');
          $type = $request->request->get('type');

      // Verrified user data in the database getDoctrine()->
          $repository = $em->getRepository('App\Entity\Users');
          $user = $repository->findOneBy([
                'type'=>$type,
                'username' => $username,
                'password' => $password,
          ]);


        if($user != null){

          return $this->render('login/home.html.twig',['response'=>'Connect with success!']);
        }
        else{

            return $this->render('login/login.html.twig',['response'=>'Username or password is incorrect!']);
          }


      // Response with feild or success login
      }

      return $this->render('login/login.html.twig');
    }



}
