<?php


namespace Album\Model;


class Album
{
    /** @var  string */
    public $photo_preview;
    /** @var  string */
    public $album_id;
    /** @var  string */
    public $spotify_url;
    /** @var  string */
    public $name;
    /** @var  string */
    public $album_type;
    /** @var  string */
    public $href;
    /** @var  string */
    public $type;
    /** @var  string */
    public $uri;
    /** @var bool */
    public $fetched_detail;

    /**
     * Album constructor.
     */
    public function __construct()
    {
        $this->images = [];
        $this->tracks = [];
        $this->fetched_detail = false;
    }


    public function exchangeArray($data)
    {
        $this->photo_preview = !empty($data['photo_preview']) ? $data['photo_preview'] : null;
        $this->album_id = !empty($data['album_id']) ? $data['album_id'] : null;
        $this->spotify_url = !empty($data['spotify_url']) ? $data['spotify_url'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;
        $this->album_type = !empty($data['album_type']) ? $data['album_type'] : null;
        $this->href = !empty($data['href']) ? $data['href'] : null;
        $this->type = !empty($data['type']) ? $data['type'] : null;
        $this->uri = !empty($data['uri']) ? $data['uri'] : null;
        $this->images = !empty($data['images']) ? $data['images'] : null;
        $this->tracks = !empty($data['tracks']) ? $data['tracks'] : null;
        $this->fetched_detail = !empty($data['fetched_detail']) ? $data['fetched_detail'] : null;
    }

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
    public function getAlbumId()
    {
        return $this->album_id;
    }

    /**
     * @param string $album_id
     * @return self
     */
    public function setAlbumId($album_id)
    {
        $this->album_id = $album_id;
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

    /**
     * @return AlbumTrack[]
     */
    public function getTracks() {
        return $this->tracks;
    }

    /**
     * @param AlbumTrack $track
     */
    public function addTrack(AlbumTrack $track)
    {
        $this->tracks[] = $track;
    }

    /**
     * @return AlbumImage[]
     */
    public function getImages() {
        return $this->images;
    }

    /**
     * @param AlbumImage $image
     */
    public function addImage(AlbumImage $image)
    {
        $this->images[] = $image;
    }

    /**
     * @return boolean
     */
    public function isFetchedDetail()
    {
        return $this->fetched_detail;
    }

    /**
     * @param boolean $fetched_detail
     * @return self
     */
    public function setFetchedDetail($fetched_detail)
    {
        $this->fetched_detail = $fetched_detail;
        return $this;
    }

}