<?php

namespace App\Controller;

use App\Entity\Note;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard', methods: ['GET', 'HEAD'])]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        // get the logged In User ID
        $user_id = $this->getUser();

        // get the notes for the logged in User
        $user_notes = $entityManager->getRepository(Note::class)->findBy(['user' => $user_id]);

        return $this->render('dashboard/index.html.twig', [
            'user_notes' => $user_notes,
        ]);
    }
}
