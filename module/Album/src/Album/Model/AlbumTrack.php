<?php


namespace Album\Model;


class AlbumTrack
{
    /** @var  string */
    public $album_id;
    /** @var  string */
    public $track_id;
    /** @var  string */
    public $preview_url;
    /** @var  string */
    public $name;
    /** @var  bool */
    public $explicit;
    /** @var  integer */
    public $track_number;
    /** @var  string */
    public $disc_number;
    /** @var  string */
    public $type;
    /** @var  string */
    public $uri;

    public function exchangeArray($data)
    {
        $this->album_id = !empty($data['album_id']) ? $data['album_id'] : null;
        $this->track_id = !empty($data['track_id']) ? $data['track_id'] : null;
        $this->preview_url = !empty($data['preview_url']) ? $data['preview_url'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;
        $this->explicit = !empty($data['explicit']) ? $data['explicit'] : null;
        $this->track_number = !empty($data['track_number']) ? $data['track_number'] : null;
        $this->disc_number = !empty($data['disc_number']) ? $data['disc_number'] : null;
        $this->type = !empty($data['type']) ? $data['type'] : null;
        $this->uri = !empty($data['uri']) ? $data['uri'] : null;
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
     */
    public function setAlbum(Album $album)
    {
        $this->album_id = $album->getAlbumId();
    }

    /**
     * @return string
     */
    public function getTrackId()
    {
        return $this->track_id;
    }

    /**
     * @param string $track_id
     * @return self
     */
    public function setTrackId($track_id)
    {
        $this->track_id = $track_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getPreviewUrl()
    {
        return $this->preview_url;
    }

    /**
     * @param string $previewUrl
     * @return self
     */
    public function setPreviewUrl($previewUrl)
    {
        $this->preview_url = $previewUrl;
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
     * @return boolean
     */
    public function isExplicit()
    {
        return $this->explicit;
    }

    /**
     * @param boolean $explicit
     * @return self
     */
    public function setExplicit($explicit)
    {
        $this->explicit = $explicit;
        return $this;
    }

    /**
     * @return int
     */
    public function getTrackNumber()
    {
        return $this->track_number;
    }

    /**
     * @param int $track_number
     * @return self
     */
    public function setTrackNumber($track_number)
    {
        $this->track_number = $track_number;
        return $this;
    }

    /**
     * @return string
     */
    public function getDiscNumber()
    {
        return $this->disc_number;
    }

    /**
     * @param string $disc_number
     * @return self
     */
    public function setDiscNumber($disc_number)
    {
        $this->disc_number = $disc_number;
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