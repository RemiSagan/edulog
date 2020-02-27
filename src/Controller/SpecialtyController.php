<?php

namespace App\Controller;

use App\Entity\Specialty;
use App\Form\SpecialtyType;
use App\Repository\SpecialtyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/specialty")
 */
class SpecialtyController extends AbstractController
{
    /**
     * @Route("/", name="specialty_index", methods={"GET"})
     */
    public function index(SpecialtyRepository $specialtyRepository): Response
    {
        return $this->render('specialty/index.html.twig', [
            'specialties' => $specialtyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="specialty_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $specialty = new Specialty();
        $form = $this->createForm(SpecialtyType::class, $specialty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $specialty
                ->setCreatedAt(new \DateTime('now'))
                ->setUpdatedAt(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($specialty);
            $entityManager->flush();

            $this->addFlash('success', 'Spécialité créee avec succès');
            return $this->redirectToRoute('specialty_index');
        }

        return $this->render('specialty/new.html.twig', [
            'specialty' => $specialty,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="specialty_show", methods={"GET"})
     */
    public function show(Specialty $specialty): Response
    {
        return $this->render('specialty/show.html.twig', [
            'specialty' => $specialty,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="specialty_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Specialty $specialty): Response
    {
        $form = $this->createForm(SpecialtyType::class, $specialty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $specialty->setUpdatedAt(new \DateTime('now'));
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Spécialité enregistrer avec succès');
            return $this->redirectToRoute('specialty_index');
        }

        return $this->render('specialty/edit.html.twig', [
            'specialty' => $specialty,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="specialty_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Specialty $specialty): Response
    {
        if ($this->isCsrfTokenValid('delete' . $specialty->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($specialty);
            $entityManager->flush();
            $this->addFlash('success', 'Spécialité supprimer avec succès');
        }

        return $this->redirectToRoute('specialty_index');
    }
}
