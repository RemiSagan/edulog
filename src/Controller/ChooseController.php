<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChooseType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChooseController extends AbstractController
{
    /**
     * @Route("/", name="choose_index")
     */
    public function index(UserRepository $userRepository)
    {
        return $this->render('choose/index.html.twig', [
            'controller_name' => 'ChooseController',
            'users' => $userRepository->findAll()
        ]);
    }

    /**
     * @Route("/{id}/choose", name="choose_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        $specialty = $user->getSpecialties();

        return $this->render('choose/show.html.twig', [
            'user' => $user,
            'specialties' => $specialty
        ]);
    }

    /**
     * @Route("/choose/{id}/edit", name="choose_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(ChooseType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUpdatedAt(new \DateTime('now'));
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Choix enregistrer avec succès');
            return $this->redirectToRoute('choose_index');
        }

        return $this->render('choose/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
