<?php

namespace App\Controller;

use App\Entity\Moyen;
use App\Form\MoyenType;
use App\Repository\MoyenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/moyen")
 */
class MoyenController extends AbstractController
{
    /**
     * @Route("/", name="moyen_index", methods={"GET"})
     */
    public function index(MoyenRepository $moyenRepository): Response
    {
        return $this->render('moyen/index.html.twig', [
            'moyens' => $moyenRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="moyen_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $moyen = new Moyen();
        $form = $this->createForm(MoyenType::class, $moyen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($moyen);
            $entityManager->flush();

            return $this->redirectToRoute('moyen_index');
        }

        return $this->render('moyen/new.html.twig', [
            'moyen' => $moyen,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="moyen_show", methods={"GET"})
     */
    public function show(Moyen $moyen): Response
    {
        return $this->render('moyen/show.html.twig', [
            'moyen' => $moyen,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="moyen_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Moyen $moyen): Response
    {
        $form = $this->createForm(MoyenType::class, $moyen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('moyen_index');
        }

        return $this->render('moyen/edit.html.twig', [
            'moyen' => $moyen,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="moyen_delete", methods={"POST"})
     */
    public function delete(Request $request, Moyen $moyen): Response
    {
        if ($this->isCsrfTokenValid('delete'.$moyen->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($moyen);
            $entityManager->flush();
        }

        return $this->redirectToRoute('moyen_index');
    }
}
