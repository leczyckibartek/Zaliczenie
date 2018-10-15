<?php
/**
 * Created by PhpStorm.
 * User: Bartek1
 * Date: 2018-10-09
 * Time: 20:32
 */

namespace App\Controller;


use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{

    /**
     * @Route("/news/{slug}")
     */
    public function show($slug, EntityManagerInterface $em)
    {

        $repository = $em->getRepository(Article::class);

        $article = $repository->findOneBy(['slug' => $slug]);
        if (!$article) {
            throw $this->createNotFoundException(sprintf('No article for slug "%s"', $slug));
        }
        return $this->render('admin_article/index.html.twig', [
            'article' => $article,
        ]);
    }

}