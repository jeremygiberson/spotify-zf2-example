<?php


namespace Album\Service;


interface AlbumServiceAwareInterface
{
    /**
     * @param AlbumService $service
     * @return mixed
     */
    public function setAlbumService(AlbumService $service);

    /**
     * @return AlbumService
     */
    public function getAlbumService();
}