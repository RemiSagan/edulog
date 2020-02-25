<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\SpecialtyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/{user}", name="homepage")
     */
    public function index(User $user)
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'user' => $user
        ]);
    }

    /**
     * @Route("/{user}/choice/", name="choice_second")
     */
    public function choiceSecond(User $user, SpecialtyRepository $specialtyRepository)
    {
        return $this->render('default/second.html.twig', [
            'user' => $user,
            'specialty' => $specialtyRepository->findAll()
        ]);
    }
}
