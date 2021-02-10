<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/secure/profile", name="app_secure_home")
     */
    public function index(): Response
    {
        return $this->render('home/profile.html.twig', ['value' => 'profile page']);
    }
}
