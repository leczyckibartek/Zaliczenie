<?php

namespace App\Controller;





use App\Entity\CvMain;
use App\Entity\Expirience;
use App\Entity\School;
use App\Form\CvType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CvController extends AbstractController
{
    /**
     * @Route("/home/cv/add", name="cv_add")
     */
    public function index(ValidatorInterface $validator,Request $request,EntityManagerInterface $em,UserInterface $user=null)
    {
        $userid = $user->getId();
        if($em->getRepository(CvMain::class)->findOneBy( ['userid' => $userid]))
        {
            $cv = $em->getRepository(CvMain::class)->findOneBy( ['userid' => $userid]);
            $cv->setPhoto("");
            $form = $this->createForm(CvType::class,$cv);
        }
        else
        {
            $cv = new CvMain();
            $cv->setUserid($userid);
            $form = $this->createForm(CvType::class,$cv);
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cv = $form->getData();
            $file = $form->get('photo')->getData();
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('photos_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $cv->setPhoto($fileName);
            $errors = $validator->validate($cv);
            if (count($errors) > 0) {
                $errorsString = (string) $errors;
                return new Response($errorsString);
            }
            $em->persist($cv);
            $em->flush();
        }

        return $this->render('cv/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }



//TODO szkoly i doswiadczenie pobrane oddzielnie w kontrolerze
    /**
     * @Route("/home/cv/show/{id}", name="cv_show")
     */
    public function show(string $id,EntityManagerInterface $em)
    {
        $cv = $em->getRepository(CvMain::class)->findOneBy(['id'=>$id]);
        $schools =  $em->getRepository(School::class)->findOneBy(['cv'=>$id]);
        $expiriences =  $em->getRepository(Expirience::class)->findOneBy(['cv'=>$id]);


        return $this->render('cv/show.html.twig',
            [
                'cv' => $cv,
                'schools'=>$schools,
                'expiriences'=>$expiriences
            ]);
    }
}