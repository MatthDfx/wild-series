<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]

    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs
        ]);
    }

    #[Route('/show/{id<^[0-9]+$>}', name: 'show')]
    public function show(int $id, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);
        // same as $program = $programRepository->find($id);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $id . ' found in program\'s table.'
            );
        }
        return $this->render('program/show.html.twig', [
            'program' => $program,
        ]);
    }

    #[Route('{programId<^[0-9]+$>}/seasons/{seasonId<^[0-9]+$>}', name: 'season_show')]
    public function showSeason(int $programId, int $seasonId, SeasonRepository $seasonRepository)
    {
        $season = $seasonRepository->findOneBy(['id' => $seasonId]);

        if (!$season) {
            throw $this->createNotFoundException(
                'No program with id : ' . $seasonId . ' found in program\'s table.'
            );
        }
        return $this->render('program/season_show.html.twig', [
            'season' => $season,
        ]);
    }
}
