<?php

namespace App\Controller;


use App\Entity\Offert;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Offert::class);

        $article = $repository->findAll();


        return $this->render('home/index.html.twig', [
        "offerts" => $article
        ]);
    }
}
