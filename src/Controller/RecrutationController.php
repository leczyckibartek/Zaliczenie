<?php
/**
 * Created by PhpStorm.
 * User: Bartek1
 * Date: 2018-11-12
 * Time: 17:14
 */

namespace App\Controller;


use App\Entity\Answer;
use App\Entity\CvMain;
use App\Entity\Offert;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class RecrutationController extends AbstractController
{

    /**
     * @Route("/home/recrutation",name="recrutation")
     */
    public function showMy(EntityManagerInterface $em, UserInterface $user = null)
    {
        $userid = $user->getId();
        $repository = $em->getRepository(Offert::class);
        $offert = $repository->findBy(
            ['employer_id' => $userid]
        );
        return $this->render('recrutation/employer.html.twig', [
            "offert" => $offert,


        ]);
    }
    /**
     * @Route("/home/recrutation/show/{id}",name="recrutation_answer")
     */
    public function Answer(EntityManagerInterface $em,string $id,UserInterface $user = null)
    {


        $Cv = $em->getRepository(Answer::class)->findBy(
            ['idOffert'=>$id]);
        $output1 = array();
        foreach ($Cv as $item)
        {
            $output1[]=$item->getIdCv();
        }
        $cvs = $em->getRepository(CvMain::class)->findBy(
            ['id'=>$output1]
        );

        return $this->render('recrutation/employerShowOne.html.twig', [
        'cvs'=>$cvs


        ]);
    }
}