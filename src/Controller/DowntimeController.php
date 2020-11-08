<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DowntimeController extends AbstractController
{
    /**
     * @Route("/downtime", name="downtime")
     */
    public function index()
    {
        return $this->render('downtime/index.html.twig', [
            'controller_name' => 'DowntimeController',
        ]);
    }
}
