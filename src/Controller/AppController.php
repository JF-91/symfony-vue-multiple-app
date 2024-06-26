<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AppController extends AbstractController
{
    #[Route('/app/{route}', requirements: ['route'=> '.*'] , name: 'app_vue')]
    public function index(): Response
    {
        return $this->render('app/index.html.twig');
    }
}
