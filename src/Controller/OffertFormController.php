<?php

namespace App\Controller;


use App\Entity\Offert;
use App\Form\OffertType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OffertFormController extends AbstractController
{
    /**
     * @Route("/offer/form", name="offer_form")
     */
    public function index(ValidatorInterface $validator,Request $request,EntityManagerInterface $em)
    {


        $offert = new Offert();
        $form = $this->createForm(OffertType::class, $offert);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $offert = $form->getData();


            $errors = $validator->validate($offert);

            if (count($errors) > 0) {
                /*
                 * Uses a __toString method on the $errors variable which is a
                 * ConstraintViolationList object. This gives us a nice string
                 * for debugging.
                 */
                $errorsString = (string) $errors;

                return new Response($errorsString);
            }



            $em->persist($offert);
             $em->flush();


        }




        return $this->render('offer_form/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
