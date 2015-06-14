<?php


namespace Album\Model;


class AlbumImage
{
    /** @var  string */
    public $album_id;
    /** @var  int */
    public $height;
    /** @var  int */
    public $width;
    /** @var  string */
    public $url;

    public function exchangeArray($data)
    {
        $this->album_id = !empty($data['album_id']) ? $data['album_id'] : null;
        $this->height = !empty($data['height']) ? $data['height'] : null;
        $this->width = !empty($data['width']) ? $data['width'] : null;
        $this->url = !empty($data['url']) ? $data['url'] : null;
    }

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
        $this->album_id = $album->getAlbumId();
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