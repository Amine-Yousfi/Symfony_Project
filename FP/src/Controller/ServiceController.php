<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route('/service', name: 'app_service')]
    public function index(): Response
    {
        return $this->render('service/index.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }


    #[Route('/teacher/{name}', name: 'showTeacher')]
    public function showTezcher($name):Response{
        return $this->render('service/showService.html.twig',['name'=>$name]);

    }



    #[Route('/gotoindex/{name}', name: 'gotoindex')]
    public function goTondex(){
        return $this->redirectToRoute('app_student'); 
    }


}
