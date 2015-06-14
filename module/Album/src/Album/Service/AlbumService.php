<?php


namespace Album\Service;


use Album\Model\Album;
use Album\Model\AlbumImage;
use Album\Model\AlbumTrack;
use Hotdog\SpotifyExampleApi\SpotifyApiAwareInterface;
use Hotdog\SpotifyExampleApi\SpotifyApiAwareTrait;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\ObjectProperty;

class AlbumService implements SpotifyApiAwareInterface
{
    use SpotifyApiAwareTrait;
    /** @var  TableGateway */
    protected $albumGateway;
    /** @var  TableGateway */
    protected $albumImageGateway;
    /** @var  TableGateway */
    protected $albumTrackGateway;

    /**
     * @return TableGateway
     */
    public function getAlbumGateway()
    {
        return $this->albumGateway;
    }

    /**
     * @param TableGateway $albumGateway
     * @return self
     */
    public function setAlbumGateway($albumGateway)
    {
        $this->albumGateway = $albumGateway;
        return $this;
    }

    /**
     * @return TableGateway
     */
    public function getAlbumImageGateway()
    {
        return $this->albumImageGateway;
    }

    /**
     * @param TableGateway $albumImageGateway
     * @return self
     */
    public function setAlbumImageGateway($albumImageGateway)
    {
        $this->albumImageGateway = $albumImageGateway;
        return $this;
    }

    /**
     * @return TableGateway
     */
    public function getAlbumTrackGateway()
    {
        return $this->albumTrackGateway;
    }

    /**
     * @param TableGateway $albumTrackGateway
     * @return self
     */
    public function setAlbumTrackGateway($albumTrackGateway)
    {
        $this->albumTrackGateway = $albumTrackGateway;
        return $this;
    }



    /**
     * @param string $query
     * @return Album[]
     */
    public function search($query) {
        $spotifyAlbumSearchResponse = $this->getSpotifyApi()->search($query);

        $albums = [];

        foreach ($spotifyAlbumSearchResponse['items'] as $item) {

            $albums[] = $this->getAlbumForSpotifySearchItem($item);
        }

        return $albums;
    }

    /**
     * @param $albumId
     * @return Album
     */
    public function get($albumId) {
        $album = $this->loadAlbum($albumId);

        if($album) {
            if(! $album->isFetchedDetail()) {
                $this->fetchDetails($album);
            }
            /** @var AlbumImage $image */
            foreach($this->getAlbumImageGateway()->select([
                'album_id' => $album->getAlbumId()
            ]) as $image) {
                $album->addImage($image);
            }
            /** @var AlbumTrack $track */
            foreach($this->getAlbumTrackGateway()->select([
                'album_id' => $album->getAlbumId()
            ]) as $track) {
                $album->addTrack($track);
            }
        }

        return $album;
    }

    /**
     * @param string $albumId
     * @return Album
     */
    private function loadAlbum($albumId)
    {
        /** @var Album $album */
        $album = $this->getAlbumGateway()->select([
            'album_id' => $albumId
        ])->current();

        return $album;
    }

    private function getAlbumForSpotifySearchItem($item)
    {
        //Query for Album and if no album exists, save album data
        /** @var Album $album */
        if(! $album = $this->loadAlbum($item['id'])) {
            $album = $this->saveAlbumData($item);
        }

        return $album;
    }

    /**
     * @param $item
     * @return Album
     */
    private function saveAlbumData($item)
    {
        $album = new Album();

        //extra array variables
        $externalUrls = $item['external_urls'];

        //Quick and dirty way to fix no images from Spotify api, could do better...
        $images = $item['images'];
        if ($images[1]){
            $previewImage = $images[1];
            $album->setPhotoPreview($previewImage['url']);
        }

        $album->setAlbumId($item['id']);
        $album->setSpotifyUrl($externalUrls['spotify']);
        $album->setName($item['name']);

        $album->setAlbumType($item['album_type']);
        $album->setHref($item['href']);
        $album->setType($item['type']);
        $album->setUri($item['uri']);

        $hydrator = new ObjectProperty();
        $data = $hydrator->extract($album);
        unset($data['tracks']);
        unset($data['images']);
        $this->getAlbumGateway()->insert($data);

        //Save Images for Album
        $this->saveAlbumImages($item, $album);

        return $album;
    }
    
    private function saveAlbumImages($item, Album $album)
    {
        foreach ($item['images'] as $image) {

            $albumImage = new AlbumImage();

            $albumImage->setAlbum($album);
            $albumImage->setHeight($image['height']);
            $albumImage->setWidth($image['width']);
            $albumImage->setUrl($image['url']);

            $this->getAlbumImageGateway()->insert((array)$albumImage);

            $album->addImage($albumImage);
        }
    }

    /**
     * Updates album with additional detail
     * @param Album $album
     */
    private function fetchDetails(Album $album)
    {
        $spotifyAlbum = $this->getSpotifyApi()->getAlbum($album->getAlbumId());

        $tracks = $spotifyAlbum['tracks'];

        foreach ($tracks['items'] as $track) {

            $albumTrack = new AlbumTrack();

            $albumTrack->setAlbum($album);
            $albumTrack->setTrackId($track['id']);
            $albumTrack->setDiscNumber($track['disc_number']);
            $albumTrack->setName($track['name']);
            $albumTrack->setPreviewUrl($track['preview_url']);
            $albumTrack->setTrackNumber($track['track_number']);
            $albumTrack->setType($track['type']);
            $albumTrack->setUri($track['uri']);

            if ($track['explicit'] == true) {
                $albumTrack->setExplicit(true);
            } else {
                $albumTrack->setExplicit(false);
            }

            $hydrator = new ObjectProperty();
            $data = $hydrator->extract($albumTrack);
            $this->getAlbumTrackGateway()->insert($data);
        }

        $this->getAlbumGateway()->update(['fetched_detail' => true],
            ['album_id' => $album->getAlbumId()]);
    }
}