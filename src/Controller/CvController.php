<?php

namespace App\Controller;
use App\Entity\CvMain;
use App\Entity\Expirience;
use App\Entity\School;
use App\Entity\SkillCv;
use App\Form\CvType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CvController extends AbstractController
{
    /**
     * @Route("/home/u/cv/add", name="cv_add")
     */
    public function add(ValidatorInterface $validator,Request $request,EntityManagerInterface $em,UserInterface $user=null)
    {
        $idOfLoggedUser = $user->getId();
        if($cv = $em->getRepository(CvMain::class)->findOneBy( ['userid' => $idOfLoggedUser]))
        {
            $photo = $cv->getPhoto();
            $form = $this->createForm(CvType::class,$cv);
        }
        else
        {
            $cv = new CvMain();
            $cv->setUserid($idOfLoggedUser);
            $form = $this->createForm(CvType::class,$cv);
            $photo = null;
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($form->get('photo')->getViewData()==null)
            {
                $cv->setPhoto($photo);
            }
            else
                {
                    $file = $form->get('photo')->getViewData();
                    $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
                    try {
                        $file->move(
                            $this->getParameter('photos_directory'),
                            $fileName
                        );
                    } catch (FileException $e) {

                    }
                    $cv->setPhoto($fileName);

                }




            $errors = $validator->validate($cv);
            if (count($errors) > 0) {
                $errorsString = (string) $errors;
                return new Response($errorsString);
            }
            $em->persist($cv);
            $em->flush();
        }
        return $this->render('cv/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
    /**
     * @Route("/home/cv/show/{id}", name="cv_show")
     */
    public function show(string $id,EntityManagerInterface $em)
    {
        $cv = $em->getRepository(CvMain::class)->findOneBy(['id'=>$id]);
        $schools =  $em->getRepository(School::class)->findBy(['cv'=>$id]);
        $expiriences =  $em->getRepository(Expirience::class)->findBy(['cv'=>$id]);
        $skill = $em->getRepository(SkillCv::class)->findBy(['cv'=>$id]);

        return $this->render('cv/show.html.twig',
            [
                'cv' => $cv,
                'schools'=>$schools,
                'expiriences'=>$expiriences,
                'skills'=>$skill
            ]);
    }
}