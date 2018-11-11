<?php

namespace App\Controller;


use App\Entity\Answer;
use App\Entity\CvMain;
use App\Entity\Offert;
use App\Entity\Skill;
use App\Form\OffertType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OffertController extends AbstractController
{
    /**
     * @Route("/home/offert/add", name="offert_add")
     */
    public function index(ValidatorInterface $validator,Request $request,EntityManagerInterface $em,UserInterface $user = null)
    {


        $userid = $user->getId();
        $offert = new Offert();
        $offert->setEmployerId($userid);
        $form = $this->createForm(OffertType::class,$offert);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $offert = $form->getData();
            $errors = $validator->validate($offert);
            if (count($errors) > 0) {
                $errorsString = (string) $errors;
                return new Response($errorsString);
            }
            $em->persist($offert);
            $em->flush();
        }
        return $this->render('offert/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/home/offert/my", name="offert_my")
     */
    public function showMy(EntityManagerInterface $em,UserInterface $user = null)
    {
        $userid = $user->getId();
        $repository = $em->getRepository(Offert::class);
        $offert = $repository->findBy(
            ['employer_id' => $userid]
        );
        return $this->render('offert/mine.html.twig', [
            "offert" => $offert,


        ]);
    }

    /**
     * @Route("/home/offert/edit/{id}", name="offert_edit")
     */
    public function edit(ValidatorInterface $validator,Request $request,EntityManagerInterface $em,string $id,UserInterface $user = null)
    {
        $offert = $em->getRepository(Offert::class)->find($id);
        $form = $this->createForm(OffertType::class, $offert);
        $username = $user->getUsername();
        $offert->setEmployerId($username);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $offert = $form->getData();
            $errors = $validator->validate($offert);
            if (count($errors) > 0) {
                $errorsString = (string) $errors;
                return new Response($errorsString);
            }
            $em->persist($offert);
            $em->flush();
        }
        return $this->render('offert/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/home/offert/show", name="offert_show_all")
     */
    public function show(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Offert::class);
        $offert = $repository->findAll();
        return $this->render('offert/all.html.twig', [
            "offerts" => $offert,

        ]);
    }

    /**
     * @Route("/home/offert/show/{id}", name="offert_show")
     */
    public function showOne(EntityManagerInterface $em,string $id)
    {

        $repository = $em->getRepository(Offert::class);
        $offert = $repository->find($id);

        return $this->render('offert/index.html.twig', [
            "offert" => $offert,
        ]);
    }
    /**
     * @Route("/home/offer/answer/{offertId}",name="answer")
     */
    public function Answer(EntityManagerInterface $em,UserInterface $user,string $offertId)
    {
        $id = $user->getId();
        $cvId = $em->getRepository(CvMain::class)->findOneBy(
            ['userid'=> $id]
        )->getId();

        if($currentAnswer = $em->getRepository(Answer::class)->findOneBy(
            ['idOffert'=> $offertId]
        ))
        {
            $currentIdOffert = $currentAnswer->getIdOffert();
            $currentIdCv = $currentAnswer->getIdCv();
            if($currentIdCv==$cvId && $currentIdOffert==$offertId)
            {
                $message = "Juz aplikowałes na to stanowisko";
            }
            else
            {
                $answer = new Answer();
                $answer->setIdCv($cvId);
                $answer->setIdOffert($offertId);
                $em->persist($answer);
                $em->flush();
                $message = "koluniu działa";
            }
        }
        else
            {
                $answer = new Answer();
                $answer->setIdCv($cvId);
                $answer->setIdOffert($offertId);
                $em->persist($answer);
                $em->flush();
                $message = "koluniu działa";

        }




         return $this->redirectToRoute('offert_show',[
             'id'=>$offertId,
             'message'=>$message,
         ]);
    }
}
