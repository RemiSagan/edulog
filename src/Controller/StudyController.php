<?php

namespace App\Controller;

use App\Entity\Study;
use App\Form\StudyType;
use App\Repository\StudyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/study")
 */
class StudyController extends AbstractController
{
    /**
     * @Route("/", name="study_index", methods={"GET"})
     */
    public function index(StudyRepository $studyRepository): Response
    {
        return $this->render('study/index.html.twig', [
            'studies' => $studyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="study_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $study = new Study();
        $form = $this->createForm(StudyType::class, $study);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($study);
            $entityManager->flush();

            return $this->redirectToRoute('study_index');
        }

        return $this->render('study/new.html.twig', [
            'study' => $study,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="study_show", methods={"GET"})
     */
    public function show(Study $study): Response
    {
        return $this->render('study/show.html.twig', [
            'study' => $study,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="study_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Study $study): Response
    {
        $form = $this->createForm(StudyType::class, $study);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('study_index');
        }

        return $this->render('study/edit.html.twig', [
            'study' => $study,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="study_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Study $study): Response
    {
        if ($this->isCsrfTokenValid('delete'.$study->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($study);
            $entityManager->flush();
        }

        return $this->redirectToRoute('study_index');
    }
}
