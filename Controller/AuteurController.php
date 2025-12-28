<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Form\AuteurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// Controller qui gère les pages liées aux auteurs
class AuteurController extends AbstractController
{
    // Route qui affiche la liste des auteurs
    #[Route('/auteurs', name: 'auteur_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // On récupère tous les auteurs en base de données
        $auteurs = $entityManager->getRepository(Auteur::class)->findAll();

        // On envoie les auteurs à la vue Twig
        return $this->render('auteur/index.html.twig', [
            'auteurs' => $auteurs
        ]);
    }

    // Route pour ajouter un nouvel auteur
    #[Route('/auteur/new', name: 'auteur_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création d'un nouvel objet Auteur
        $auteur = new Auteur();

        // Création du formulaire lié à l'entité Auteur
        $form = $this->createForm(AuteurType::class, $auteur);

        // Récupération des données du formulaire
        $form->handleRequest($request);

        // Si le formulaire est envoyé et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarde de l'auteur en base de données
            $entityManager->persist($auteur);
            $entityManager->flush();

            // Redirection vers la liste des auteurs
            return $this->redirectToRoute('auteur_index');
        }

        // Affichage du formulaire
        return $this->render('auteur/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
    // Modifier un auteur
    #[Route('/auteur/{id}/edit', name: 'auteur_edit')]
    public function edit(Auteur $auteur, Request $request, EntityManagerInterface $entityManager): Response
    {
        // On réutilise le même formulaire que pour la création
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);

        // Mise à jour de l'auteur
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('auteur_index');
        }

        return $this->render('auteur/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Supprimer un auteur
    #[Route('/auteur/{id}/delete', name: 'auteur_delete')]
    public function delete(Auteur $auteur, EntityManagerInterface $entityManager): Response
    {
        // Suppression de l'auteur
        $entityManager->remove($auteur);
        $entityManager->flush();

        return $this->redirectToRoute('auteur_index');
    }
}

