<?php

namespace App\Controller;

use App\Entity\Offert;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $em,UserInterface $user = null)
    {
        $repository = $em->getRepository(Offert::class);
        $offerts = $repository->findByExampleField();
        $users = $user->getUsername();
        return $this->render('home/index.html.twig', [
        "offerts" => $offerts,
        "users" => $users,
        ]);
    }


}
