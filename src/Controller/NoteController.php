<?php

namespace App\Controller;

use App\Entity\Note;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NoteController extends AbstractController
{
    #[Route('/note', name: 'create_note', methods: ['POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        $user_id = $this->getUser();

        $note = new Note();
        $note->setTitle($request->request->get('title'));
        $note->setUser($user_id);
        $note->setDescription($request->request->get('note_description'));
        $entityManager->persist($note);
        $entityManager->flush();

        return $this->redirectToRoute('app_dashboard');

    }
}
