<?php

namespace App\Controller;

use App\Repository\TechnoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(TechnoRepository $technoRepository): Response
    {
        $frontTechnos = $technoRepository->findByFrontTechno();
        $backTechnos = $technoRepository->findByBackTechno();

        return $this->render('base.html.twig', [
            'frontTechnos' => $frontTechnos,
            'backTechnos' => $backTechnos,
        ]);
    }
}
