<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserSettingsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/secure/profile", name="app_secure_home")
     */
    public function index(): Response
    {
        return $this->render('home/profile.html.twig', ['user' => $this->getUser()]);
    }

    /**
     * @Route("/secure/profile/settings", name="app_secure_settings")
     */
    public function settings(Request $request): Response
    {
        $userSettingsForm = $this->createForm(UserSettingsType::class, $this->getUser());

        $userSettingsForm->handleRequest($request);

        if ($userSettingsForm->isSubmitted() && $userSettingsForm->isValid()) {
            $userData = $userSettingsForm->getData();
            dump($userData);
            $userRepo = $this->getDoctrine()->getRepository(User::class);
            $userRepo->save($userData);
        }

        return $this->render('home/profile_settings.html.twig', [
            'userSettingsForm' => $userSettingsForm->createView(),
        ]);
    }

}
