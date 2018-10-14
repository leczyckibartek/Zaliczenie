<?php
/**
 * Created by PhpStorm.
 * User: Bartek1
 * Date: 2018-10-09
 * Time: 20:32
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function Hello()

    {
        return $this->render("base.html.twig");
    }


}