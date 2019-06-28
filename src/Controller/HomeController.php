<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\CvMain;
use App\Entity\Offert;
use App\Entity\User;
use App\Form\AvatarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(EntityManagerInterface $em,UserInterface $user=null)
    {
        $userid = $user->getUsername();
        $repository = $em->getRepository(Offert::class)->findBy(['employer_id' => $userid]);
        $idOfOfferts = [];
        foreach ($repository as $item)
        {
            $idOfOfferts[] = $item->getId();
        };
        $ReceivedCv = $em->getRepository(Answer::class)->findBy(['idOffert' => $idOfOfferts]);

        $idOfCv = [];
        foreach ($ReceivedCv as $item)
        {
            $idOfCv[] = $item->getIdCv();
        };
        $cvs = $em->getRepository(CvMain::class)->findBy(['id' => $idOfCv]);
        $offerts = $em->getRepository(Offert::class)->findByExampleField();
        return $this->render('home/index.html.twig', [
        "offerts" => $offerts,
        'cvs' => $cvs
        ]);
    }
    /**
     * @Route("/home/avatar", name="avatar")
     */
    public function change(EntityManagerInterface $em,UserInterface $user=null,Request $request,ValidatorInterface $validator)
    {
        $user = $em->getRepository(User::class)->findOneBy(['id'=>$user->getId()]);
        $form = $this->createForm(AvatarType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted() ) {
            $file = $form->get('avatar')->getData();

            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('avatar_directory'),
                    $fileName
                );
            } catch (FileException $e) {

            }
            $user->setAvatar($fileName);
            $errors = $validator->validate($user);
            if (count($errors) > 0) {
                $errorsString = (string) $errors;
                return new Response($errorsString);
            }
            $em->persist($user);
            $em->flush();
        }
        return $this->render('home/avatar.html.twig', [
            "form" => $form->createView(),
        ]);
    }
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }



}
