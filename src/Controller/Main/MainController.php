<?php


namespace App\Controller\Main;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {

        return $this->render('main/main.html.twig', [

        ]);
    }
}