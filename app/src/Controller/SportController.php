<?php

namespace App\Controller;

use App\Repository\SportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SportController extends AbstractController
{
    private $sportRepository;

    /**
     * SportController constructor.
     *
     * @param SportRepository $sportRepository
     */
    public function __construct(SportRepository $sportRepository)
    {
        $this->sportRepository = $sportRepository;
    }

    /**
     * @Route("/sport", name="sport")
     */
    public function index(): Response
    {
        return $this->render('sport/index.html.twig', [
            'controller_name' => 'SportController',
            'sports' => $this->sportRepository->findAll()


        ]);
    }
}
