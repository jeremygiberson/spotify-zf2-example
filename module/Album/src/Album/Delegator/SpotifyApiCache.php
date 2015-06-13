<?php


namespace Album\Delegator;


use Hotdog\SpotifyExampleApi\SpotifyApiInterface;
use Zend\Cache\Storage\StorageInterface;

class SpotifyApiCache implements SpotifyApiInterface
{
    /** @var  SpotifyApiInterface */
    protected $realSpotifyApi;
    /** @var  StorageInterface */
    protected $cache;

    /**
     * SpotifyApiCache constructor.
     * @param SpotifyApiInterface $realSpotifyApi
     * @param StorageInterface $cache
     */
    public function __construct(SpotifyApiInterface $realSpotifyApi, StorageInterface $cache)
    {
        $this->realSpotifyApi = $realSpotifyApi;
        $this->cache = $cache;
    }


    /**
     * Query the Spotify API for an album search
     *
     * @param $query
     * @return mixed
     */
    public function search($query)
    {
        $key = md5($query);
        if($this->cache->hasItem($key)){
            return unserialize($this->cache->getItem($key));
        }

        $results = $this->realSpotifyApi->search($query);

        $this->cache->setItem($key, serialize($results));
        return $results;
    }

    /**
     * Query the Spotify API for a specific Album
     *
     * @param $id
     * @return mixed
     */
    public function getAlbum($id)
    {
        $key = md5($id);
        if($this->cache->hasItem($key)){
            return unserialize($this->cache->getItem($key));
        }

        $results = $this->realSpotifyApi->getAlbum($id);

        $this->cache->setItem($key, serialize($results));
        return $results;
    }
}