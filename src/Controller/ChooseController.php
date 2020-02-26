<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChooseType;
use App\Entity\Specialty;
use App\Repository\SpecialtyRepository;
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

        return $this->render('user/show.html.twig', [
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

            return $this->redirectToRoute('choose_index');
        }

        return $this->render('choose/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/choose", name="choose_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
