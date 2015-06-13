<?php


namespace Album\Service;

/**
 * Class AlbumServiceAwareTrait
 * @package Album\Service
 * @satisfies AlbumServiceAwareInterface
 */
trait AlbumServiceAwareTrait
{
    /** @var  AlbumService */
    private $albumService;

    /**
     * @return AlbumService
     */
    public function getAlbumService()
    {
        return $this->albumService;
    }

    /**
     * @param AlbumService $albumService
     * @return self
     */
    public function setAlbumService(AlbumService $albumService)
    {
        $this->albumService = $albumService;
        return $this;
    }

}