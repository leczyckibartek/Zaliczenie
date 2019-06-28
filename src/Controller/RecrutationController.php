<?php
namespace App\Controller;


use App\Entity\Answer;
use App\Entity\CvMain;
use App\Entity\Offert;
use App\Entity\Skill;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Form\TaskAnswerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RecrutationController extends AbstractController
{

    /**
     * @Route("/home/e/recrutation",name="recrutation")
     */
    public function showMy(EntityManagerInterface $em, UserInterface $user = null)
    {
        $userid = $user->getUsername();
        $repository = $em->getRepository(Offert::class);
        if($offert = $repository->findBy(
            ['employer_id' => $userid]
        )){
        return $this->render('recrutation/employer.html.twig', [
            "offert" => $offert,
        ]);
    }
    else{
        return $this->render('recrutation/employer.html.twig');
    }

    }
    /**
     * @Route("/home/u/recrutation/show/{id}",name="recrutation_answer")
     */
    public function Answer(EntityManagerInterface $em,string $id,Request $request,ValidatorInterface $validator)
    {
        $answers = $em->getRepository(Answer::class)->findBy(
            ['idOffert'=>$id]);
        $idOfCvs = array();
        foreach ($answers as $item)
        {
            $idOfCvs[]=$item->getIdCv();
        }
        $fullCv = $em->getRepository(CvMain::class)->findBy(
            ['id'=>$idOfCvs]
        );
        $idFromCvs = array();
        foreach ($fullCv as $item)
        {
            $idFromCvs[]=$item->getUserid();
        }
        $currentCvId = 0;
        foreach ($fullCv as $item)
        {
            $currentCvId=$item->getId();
        }
        $emails = $em->getRepository(User::class)->findBy(['id'=>$idFromCvs]);


        $tasks = new Answer();
        $tasks->setUserId($currentCvId);
        $form = $this->createForm(TaskAnswerType::class,$tasks);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());
            die();
            $tasks = $form->getData();

            $errors = $validator->validate($tasks);
            if (count($errors) > 0) {
                $errorsString = (string) $errors;
                return new Response($errorsString);
            }
            $em->persist($tasks);
            $em->flush();
        }

        return $this->render('recrutation/employerShowOne.html.twig', [
            'cvs'=>$fullCv,
            'emails'=>$emails,
            'form'=>$form->createView()



        ]);
    }
    /**
     * @Route("home/e/recrutation/delete/{id}", name="delete_offert")
     */
    public function deleteAction(string $id,EntityManagerInterface $em)
    {

        $offert = $em->getRepository(Offert::class)->find($id);
        $skill = $em->getRepository(Skill::class)->find($id);
        if ($offert) {
            if($skill){
                $offert->removeSkill($skill);
            }
            $em->remove($offert);
            $em->flush();
            return $this->redirectToRoute('recrutation');
        }
        return $this->redirectToRoute('recrutation');


    }
    /**
     * @Route("/home/offer/answer/{offertId}",name="answer")
     */
    public function SendAplication(EntityManagerInterface $em,UserInterface $user,int $offertId)
    {
        $id = $user->getId();
        if(!$em->getRepository(CvMain::class)->findOneBy(
            ['userid' => $id]
        ))
        {
            $this->addFlash(
                'alert',
                "NAJPIERW UTWÓRZ CV"
            );
            return $this->redirectToRoute('offert_show',[
                'id'=>$offertId,
            ]);

        }
        $cvId = $em->getRepository(CvMain::class)->findOneBy(
            ['userid'=> $id]
        )->getId();
        if($currentAnswer = $em->getRepository(Answer::class)->findOneBy(
            ['idOffert'=> $offertId]
        ))
        {
            $currentIdOffert = $currentAnswer->getIdOffert();
            $currentIdCv = $currentAnswer->getIdCv();

            if($currentIdCv===$cvId && $currentIdOffert===$offertId)
            {
                $this->addFlash(
                    'alert',
                    "JUŻ APLIKOWAŁEŚ NA TO STANOWISKO"
                );
            }
            else
            {
                $userId = $em->getRepository(Offert::class)->findOneBy(['id'=>$offertId])->getEmployerId();
//                dump($userId);
//                die();
                $answer = new Answer();
                $answer->setIdCv($cvId);
                $answer->setIdOffert($offertId);
                $answer->setUserId($userId);
                $em->persist($answer);
                $em->flush();
                $this->addFlash(
                    'message',
                    "WYSŁANO CV"
                );
            }
        }
        else
        {
            $userId = $em->getRepository(Offert::class)->findOneBy(['id'=>$offertId])->getEmployerId();
//                dump($userId);
//                die();
            $answer = new Answer();
            $answer->setIdCv($cvId);
            $answer->setIdOffert($offertId);
            $answer->setUserId($userId);
            $em->persist($answer);
            $em->flush();
            $this->addFlash(
                'message',
                "WYSLANO CV"
            );

        }




        return $this->redirectToRoute('offert_show',[
            'id'=>$offertId,
        ]);
    }
}