<?php

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
    public function add(UserInterface $user,Request $request,ValidatorInterface $validator,EntityManagerInterface $em){
        $email = $user->getEmail();
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
     * @Route("/home/message/add/{receiver}",name="message_to_one")
     */
    public function addDirect(UserInterface $user,Request $request,ValidatorInterface $validator,EntityManagerInterface $em,string $receiver){
        $email= $user->getEmail();
        $message = new Message();
        $message->setSender($email);
        $message->setReceiver($receiver);
        $form = $this->createForm(MessageType::class,$message);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $message = $form->getData();
            $errors = $validator->validate($message);
            if (count($errors) > 0) {
                $errorsString = (string) $errors;
                return new Response($errorsString);
            }
            $em->persist($message);
            $em->flush();
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
    /**
     * @Route("/home/message/show/{id}",name="message_show")
     */
    public function show(UserInterface $user,EntityManagerInterface $em,string $id){

        $message = $em->getRepository(Message::class)->find($id);

        return $this->render('message/show.html.twig', [
            'message' => $message,
        ]);
    }


    /**
     * @Route("home/message/delete/{id}", name="message_delete")
     */
    public function deleteAction(string $id,EntityManagerInterface $em)
    {

        $message = $em->getRepository(Message::class)->find($id);

        if ($message) {
            $em->remove($message);
            $em->flush();
            return $this->redirectToRoute('message_show_received');
        }
        return $this->redirectToRoute('message_show_received');


    }
}