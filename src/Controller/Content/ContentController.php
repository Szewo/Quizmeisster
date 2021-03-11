<?php


namespace App\Controller\Content;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContentController extends AbstractController
{
    /**
     * @Route("/homepage", name="homepage")
     */
    public function index() {
        return $this->render('content/homepage.html.twig');
    }

}