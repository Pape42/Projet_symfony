<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// Controller qui gère les livres
class LivreController extends AbstractController
{
    // Liste des livres
    #[Route('/livres', name: 'livre_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $livres = $entityManager->getRepository(Livre::class)->findAll();

        return $this->render('livre/index.html.twig', [
            'livres' => $livres
        ]);
    }

    // Ajouter un nouveau livre
    #[Route('/livre/new', name: 'livre_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($livre);
            $entityManager->flush();

            return $this->redirectToRoute('livre_index');
        }

        return $this->render('livre/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Modifier un livre
    #[Route('/livre/{id}/edit', name: 'livre_edit')]
    public function edit(Livre $livre, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('livre_index');
        }

        return $this->render('livre/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Supprimer un livre
    #[Route('/livre/{id}/delete', name: 'livre_delete')]
    public function delete(Livre $livre, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($livre);
        $entityManager->flush();

        return $this->redirectToRoute('livre_index');
    }
}
