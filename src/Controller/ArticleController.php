<?php
/**
 * Created by PhpStorm.
 * User: Bartek1
 * Date: 2018-10-09
 * Time: 20:32
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleController
{

    /**
     * @Route("/")
     */
    public function homepage()

    {
        return new Response('JAZDA');
    }
}