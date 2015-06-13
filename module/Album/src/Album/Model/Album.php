<?php


namespace Album\Model;


class Album
{
    /** @var  string */
    protected $photo_preview;
    /** @var  string */
    protected $spotify_id;
    /** @var  string */
    protected $spotify_url;
    /** @var  string */
    protected $name;
    /** @var  string */
    protected $album_type;
    /** @var  string */
    protected $href;
    /** @var  string */
    protected $type;
    /** @var  string */
    protected $uri;

    /**
     * @return string
     */
    public function getPhotoPreview()
    {
        return $this->photo_preview;
    }

    /**
     * @param string $photo_preview
     * @return self
     */
    public function setPhotoPreview($photo_preview)
    {
        $this->photo_preview = $photo_preview;
        return $this;
    }

    /**
     * @return string
     */
    public function getSpotifyId()
    {
        return $this->spotify_id;
    }

    /**
     * @param string $spotify_id
     * @return self
     */
    public function setSpotifyId($spotify_id)
    {
        $this->spotify_id = $spotify_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSpotifyUrl()
    {
        return $this->spotify_url;
    }

    /**
     * @param string $spotify_url
     * @return self
     */
    public function setSpotifyUrl($spotify_url)
    {
        $this->spotify_url = $spotify_url;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlbumType()
    {
        return $this->album_type;
    }

    /**
     * @param string $album_type
     * @return self
     */
    public function setAlbumType($album_type)
    {
        $this->album_type = $album_type;
        return $this;
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param string $href
     * @return self
     */
    public function setHref($href)
    {
        $this->href = $href;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     * @return self
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }


}