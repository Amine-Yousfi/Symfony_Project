<?php

namespace App\Controller;

use App\Entity\Auteur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuteurRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\AuteurType;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/show/{name}', name: 'app_show')]
    public function showAuthor($name): Response
    {
        return $this->render('author/show.html.twig', ['name'=>$name]);
    }

    #[Route('/list', name: 'app_list')]
    public function list(): Response
    {
        $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg','username' => 'Victor Hugo', 'email' =>
            'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpg','username' => ' William Shakespeare', 'email' =>
            ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg','username' => 'Taha Hussein', 'email' =>
            'taha.hussein@gmail.com', 'nb_books' => 300),
            );
        return $this->render('author/list.html.twig', ['list'=>$authors]);
    }

    #[Route('/showA/{id}', name: 'showA')]
    public function ShowA($id, AuteurRepository $repo){
        $author=$repo-> find($id);
        return $this->render('author/showA.html.twig',['author'=>$author]);

    }

    #[Route('/listA', name: 'list')]
    public function listA(AuteurRepository $repo):Response{
        $list=$repo-> findAll();
        return $this->render('author/list.html.twig',['Authors'=>$list]);

    }

    #[Route('/delete/{id}', name: 'app_delete')]
    public function deleteAuteur($id,AuteurRepository $repo,ManagerRegistry $manager){
        $auteur=$repo-> find($id);
        $res=$manager->getManager();
        $res->remove($auteur);
        $res->flush();
        return $this->redirectToRoute('list');

    }

    #[Route('/add/{id}', name: 'addStatic')]
    public function addStatic(ManagerRegistry $manager){
        $auteur=new Auteur();
        $auteur->setUserName('foulen');
        $auteur->setEmail('foulen@gmail.com');
        $res=$manager->getManager();
        $res->persist($auteur);
        $res->flush();
        return new Response('saved new product with id'.$auteur->getId());

    }

    #[Route('/addA', name: 'addA')]
    public function addA(Request $req, ManagerRegistry $manager){
        $auteur=new Auteur();
        $form=$this->createForm(AuteurType::class ,$auteur);
        $form-> add('Add',SubmitType::class);
        $form->handleRequest($req);
        
        if($form->isSubmitted()){
            $res=$manager->getManager();
            $res->persist($auteur);
            $res->flush();
            return $this->redirectToRoute('list');
        }

        return $this->render('author/add.html.twig',['forms'=>$form->createView()]);
    }


    #[Route('/uppdate/{id}', name: 'app_update')]
    public function update($id,AuteurRepository $repo, Request $req ,ManagerRegistry $manager){
        $auteur=new Auteur();
        $form=$this->createForm(AuteurType::class ,$auteur);
        $form-> add('update',SubmitType::class);  
        $form->handleRequest($req);  
        if($form->isSubmitted()){
            $res=$manager->getManager();
            $res->persist($auteur);
            $res->flush();
            return $this->redirectToRoute('list');   } 

        return $this->render('author/update/add.html.twig',['forms'=>$form->createView()]);
    }



}
