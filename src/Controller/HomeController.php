<?php

namespace App\Controller;

use App\Entity\Experience;
use App\Entity\Realisation;
use App\Repository\DegreeRepository;
use App\Repository\ExperienceRepository;
use App\Repository\RealisationRepository;
use App\Repository\TechnoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(RealisationRepository $realisationRepository ,TechnoRepository $technoRepository, ExperienceRepository $experienceRepository, DegreeRepository $degreeRepository): Response
    {
        $frontTechnos = $technoRepository->findByFrontTechno();
        $backTechnos = $technoRepository->findByBackTechno();

        $experiences = $experienceRepository->findAll();
        $degrees = $degreeRepository->findAllByDate();
        $realisations = $realisationRepository->findAll();



        return $this->render('base.html.twig', [
            'frontTechnos' => $frontTechnos,
            'backTechnos' => $backTechnos,
            'experiences' => $experiences,
            'degrees' => $degrees,
            'realisations' => $realisations,
        ]);
    }
}
