<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Classroom;
use App\Form\ClassroomType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="classroom")
     */
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    /**
     * @Route("/afficheC", name="afficheC")
     */
    public function afficheC(): Response
    {
        //récupérer le repository pour utiliser la fonction findAll()
        $r=$this->getDoctrine()->getRepository(Classroom::class);
        //Faire appel à la fonction findAll()
        $classrooms=$r->findAll();
        return $this->render('classroom/afficheC.html.twig', [
            'c' => $classrooms
        ]);
    }

    /**
     * @Route("/supp/{id}", name="suppC")
     */
    public function supp($id): Response
    {
        //récupérer le classroom à supprimer
        $classroom=$this->getDoctrine()
            ->getRepository(Classroom::class)->find($id);
        //On passe à la suppression
        $em=$this->getDoctrine()->getManager();
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute('afficheC');
    }

    /**
     * @Route("/ajoutC", name="ajoutC")
     */
    public function ajoutC(Request $request): Response
    {

        //création du formulaire
        $c=new Classroom();
        $form=$this->createForm(ClassroomType::class,$c);
//recupérer les données saisies depuis la requete http
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($c);
            $em->flush();
            return $this->redirectToRoute('afficheC');
        }

        return $this->render('classroom/ajoutC.html.twig', [
            'f' => $form->createView(),
        ]);
    }
    /**
     * @Route("/modifC/{id}", name="modifC")
     */
    public function modifC(Request $request, $id): Response
    {
        //récupérer le classroom à modifier
        $classroom=$this->getDoctrine()
            ->getRepository(Classroom::class)->find($id);
        //création du formulaire rempli
        $form=$this->createForm(ClassroomType::class,$classroom);
//recupérer les données saisies depuis la requete http
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('afficheC');
        }
        return $this->render('classroom/ajoutC.html.twig', [
            'f' => $form->createView(),
        ]);
    }
}
