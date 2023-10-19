<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }


    #[Route('/home/{id}', name: 'app_home')]
    public function home($id): Response
    {
        //return new Response("hello 3A".$id);
        return $this->render('student/home.html.twig',['valeur'=>$id]);
    }
}
