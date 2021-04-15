<?php

namespace App\Controller;

use App\Entity\TeamPlayer;
use App\Repository\TeamPlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;


class TeamPlayerController extends AbstractController
{

    /**
     * @var TeamPlayerRepository
     */
    private TeamPlayerRepository $teamPlayerRepository;

    /**
     * @var CacheInterface
     */
    private CacheInterface $cache;

    public function __construct(TeamPlayerRepository $teamPlayerRepository, CacheInterface $cache)
    {
        $this->teamPlayerRepository = $teamPlayerRepository;
        $this->cache = $cache;
    }

    /**
     * @Route("/team_player", name="team_player")
     */
    public function index(): Response
    {
        return $this->render('team_player/index.html.twig', [
            'controller_name' => 'TeamPlayerController',
        ]);
    }

    /**
     * @Route("/team_player/rand", name="team_player_rand")
     */
    public function rand(): Response
    {

        return $this->render('team_player/index.html.twig', [
            'controller_name' => 'TeamPlayerController',
            'player' => $this->getFromCache($this->teamPlayerRepository->randomId())

        ]);
    }

    private function getFromCache($randId)
    {
        return $this->cache->get(
            'team_player_' . $randId,
            function (ItemInterface $item) use ($randId){
                $item->expiresAfter(3600);

                return $this->teamPlayerRepository->find($randId);
            }

        );
    }


}
