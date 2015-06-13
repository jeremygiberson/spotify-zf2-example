<?php


namespace Album\Model;


class AlbumImage
{
    /** @var  string */
    protected $album_id;
    /** @var  int */
    protected $height;
    /** @var  int */
    protected $width;
    /** @var  string */
    protected $url;

    /**
     * @return string
     */
    public function getAlbumId()
    {
        return $this->album_id;
    }

    /**
     * @param Album $album
     * @return self
     */
    public function setAlbum($album)
    {
        $this->album_id = $album->getSpotifyId();
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return self
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return self
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

}