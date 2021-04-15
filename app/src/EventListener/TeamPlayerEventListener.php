<?php


namespace App\EventListener;


use App\Entity\TeamPlayer;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Contracts\Cache\CacheInterface;

class TeamPlayerEventListener
{
    /**
     * @var CacheInterface
     */
    private CacheInterface $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    public function postUpdate(TeamPlayer $player, LifecycleEventArgs $lifecycleEventArgs)
    {
        $this->cache->delete('team_player_' . $player->id);
    }
}