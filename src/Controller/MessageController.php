<?php
/**
 * Created by PhpStorm.
 * User: Bartek1
 * Date: 2018-11-23
 * Time: 10:11
 */

namespace App\Controller;


use App\Entity\Message;
use App\Entity\User;
use App\Form\MessageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MessageController extends AbstractController
{
    /**
     * @Route("/home/message/add",name="message_add")
     */
    public function index(UserInterface $user,Request $request,ValidatorInterface $validator,EntityManagerInterface $em){
        $email= $user->getEmail();
        $message = new Message();
        $message->setSender($email);
        $form = $this->createForm(MessageType::class,$message);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $message = $form->getData();
           $email = $message->getReceiver();
          if( $em->getRepository(User::class)->findOneBy(['email'=>$email]))
          {
              $em->persist($message);
              $em->flush();
          }
          else{
              $this->addFlash(
                  'alert',
                  "NIE ZNALEZIONO UŻYTKOWNIKA"
              );
          }
            $errors = $validator->validate($message);
            if (count($errors) > 0) {
                $errorsString = (string) $errors;
                return new Response($errorsString);
            }

        }
        return $this->render('message/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/home/message/show/received",name="message_show_received")
     */
    public function received(UserInterface $user,EntityManagerInterface $em){
        $email = $user->getEmail();
        $messages = $em->getRepository(Message::class)->findBy(['receiver'=>$email]);

        return $this->render('message/all.html.twig', [
            'messages' => $messages,
        ]);
    }
    /**
     * @Route("/home/message/show/sent",name="message_show_sent")
     */
    public function send(UserInterface $user,EntityManagerInterface $em){
        $email = $user->getEmail();
        $messages = $em->getRepository(Message::class)->findBy(['sender'=>$email]);

        return $this->render('message/allsent.html.twig', [
            'messages' => $messages,
        ]);
    }
}