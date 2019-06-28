<?php

namespace App\Controller;


use App\Entity\Answer;
use App\Entity\AnswerTask;
use App\Entity\CvMain;
use App\Entity\Task;
use App\Entity\User;
use App\Form\SendFileType;
use App\Form\TaskAnswerType;
use App\Form\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TaskController extends AbstractController
{
    /**
     * @Route("/home/e/task/add",name="task_add")
     */
    public function index(UserInterface $user,Request $request,ValidatorInterface $validator,EntityManagerInterface $em){
        $userId = $user->getId();
        $task = new Task();
        $task->setUserId($userId);
        $form = $this->createForm(TaskType::class,$task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $errors = $validator->validate($task);
            if (count($errors) > 0) {
                $errorsString = (string) $errors;
                return new Response($errorsString);
            }
            $em->persist($task);
            $em->flush();

        }
        $tasks = $em->getRepository(Task::class)->findBy(['UserId'=>$userId]);
        return $this->render('task/add.html.twig', [
            'form' => $form->createView(),
        'tasks'=>$tasks,
        ]);
    }
    /**
     * @Route("/home/e/task/send/{id}",name="task_send")
     */
    public function send(UserInterface $user,Request $request,ValidatorInterface $validator,EntityManagerInterface $em,string $id)
    {

        $answer = $em->getRepository(Answer::class)->findOneBy(['idCv' => $id]);
        if($answer->getAnswer() == null) {
            $form = $this->createForm(TaskAnswerType::class,$answer);
            $form->handleRequest($request);
            if ($form->isSubmitted() ) {
                $answer = $form->getData();
                $taskId = $form->get('taskId')->getData()->getId();
                $answer->setTaskId($taskId);

                $errors = $validator->validate($answer);
                if (count($errors) > 0) {
                    $errorsString = (string) $errors;
                    return new Response($errorsString);
                }
                $em->persist($answer);
                $em->flush();

            }
            return $this->render('task/send.html.twig', [
                'form' => $form->createView()
            ]);

        }
        else{
          $answers =  $answer->getAnswer();
            return $this->render('task/send.html.twig', [
                'answer' => $answers
            ]);
        }
    }
    /**
     * @Route("/home/task/show",name="task_show")
     */
    public function show(UserInterface $user,Request $request,ValidatorInterface $validator,EntityManagerInterface $em){$idCv =  $em->getRepository(CvMain::class)->findOneBy(['userid'=>$user->getId()])->getId();
     $task = $em->getRepository(Answer::class)->findBy(['idCv'=>$idCv]);

     $iteration =[];
     foreach ($task as $item ){
         $iteration[] = $item->getTaskId();
     }
        $taskName = $em->getRepository(Task::class)->findBy(['id'=>$iteration]);
        $usera= $em->getRepository(User::class)->findBy(['id'=>$taskName]);

        return $this->render('task/show.html.twig', [
            'tasks'=>$task,
            'names'=>$taskName,
            'avatar'=>$usera

        ]);
    }
    /**
     * @Route("/home/task/show/{id}",name="task_show_one")
     */
    public function showOne(UserInterface $user,Request $request,ValidatorInterface $validator,EntityManagerInterface $em,string $id){
        $task= $em->getRepository(Task::class)->find($id);
        return $this->render('task/showOne.html.twig', [
            'task'=>$task,
        ]);
    }

    /**
     * @Route("/home/u/task/answer/{id}",name="task_answer")
     */
    public function Answer(UserInterface $user,Request $request,ValidatorInterface $validator,EntityManagerInterface $em,string $id){
        $task= $em->getRepository(Answer::class)->find($id);
        $form = $this->createForm(SendFileType::class,$task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $file = $form->get('answer')->getData();

            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('files_directory'),
                    $fileName
                );
            } catch (FileException $e) {

            }
            $task->setAnswer($fileName);
//            $errors = $validator->validate($task);
//            if (count($errors) > 0) {
//                $errorsString = (string)$errors;
//                return new Response($errorsString);
//            }
            $em->persist($task);
            $em->flush();
        }
        return $this->render('task/answer.html.twig', [

     'form'=>$form->createView(),
        ]);
    }
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
    /**
     * @Route("home/task/delete/{id}", name="delete_task")
     */
    public function deleteAction(string $id,EntityManagerInterface $em)
    {

        $task = $em->getRepository(Task::class)->find($id);

        if ($task) {
            $em->remove($task);
            $em->flush();
            return $this->redirectToRoute('recrutation');
        }
        return $this->redirectToRoute('recrutation');


    }

}