<?php

namespace App\Controller;


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
     * @Route("/offert/add", name="offert_add")
     */
    public function index(ValidatorInterface $validator,Request $request,EntityManagerInterface $em,UserInterface $user = null)
    {

        $form = $this->createForm(OffertType::class);
        $username = $user->getUsername();
        $offert = new Offert();
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
        return $this->render('offert/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/offert/my", name="offert_my")
     */
    public function showMy(EntityManagerInterface $em,UserInterface $user = null)
    {
        $username = $user->getUsername();
        $repository = $em->getRepository(Offert::class);
        $offert = $repository->findBy(
            ['employer_id' => $username]
        );
        return $this->render('offert/mine.html.twig', [
            "offert" => $offert,


        ]);
    }

    /**
     * @Route("/offert/edit/{id}", name="offert_edit")
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
     * @Route("/offert/show", name="offert_show_all")
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
     * @Route("/offert/show/{id}", name="offert_show")
     */
    public function showOne(EntityManagerInterface $em,string $id)
    {

        $repository = $em->getRepository(Offert::class);
        $offert = $repository->find($id);

        return $this->render('offert/index.html.twig', [
            "offert" => $offert,


        ]);
    }
}
