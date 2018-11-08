<?php
namespace App\Controller;

use App\Entity\Task;
use App\Entity\Tag;
use App\Form\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;

class TaskController extends AbstractController
{
    /**
     * @Route("/task", name="task")
     */
public function new(Request $request)
{
$task = new Task();



$form = $this->createForm(TaskType::class);

$form->handleRequest($request);
$em = $this->getDoctrine()->getManager();
if ($form->isSubmitted() && $form->isValid()) {

    $data = $form->getData();
//    foreach($data->getTags() as $item){
//        $item->addTag();
//    }
    $em->persist($data);
    $em->flush();

}

return $this->render('task/new.html.twig', array(
'form' => $form->createView(),
));
}
    /**
     * @Route("/task/edit", name="taske")
     */
    public function edit( Request $request, EntityManagerInterface $entityManager)
    {

            $task = new Task();
        $originalTags = new ArrayCollection();

        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($task->getTags() as $tag) {
            $originalTags->add($tag);
        }

        $editForm = $this->createForm(TaskType::class, $task);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // remove the relationship between the tag and the Task
            foreach ($originalTags as $tag) {
                if (false === $task->getTags()->contains($tag)) {
                    // remove the Task from the Tag
                    $tag->getTasks()->removeElement($task);

                    // if it was a many-to-one relationship, remove the relationship like this
                    // $tag->setTask(null);

                    $entityManager->persist($tag);

                    // if you wanted to delete the Tag entirely, you can also do that
                    // $entityManager->remove($tag);
                }
            }

            $entityManager->persist($task);
            $entityManager->flush();

            // redirect back to some edit page
             $this->redirectToRoute('task');
        }

        return $this->render('task/new.html.twig', array(
            'form' => $editForm->createView(),
        ));
    }
}