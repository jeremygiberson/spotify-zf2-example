<?php


namespace Album\Service;


use Album\Model\Album;
use Album\Model\AlbumImage;
use Hotdog\SpotifyExampleApi\SpotifyApiAwareInterface;
use Hotdog\SpotifyExampleApi\SpotifyApiAwareTrait;

class AlbumService implements SpotifyApiAwareInterface
{
    use SpotifyApiAwareTrait;

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
    public function get($albumId) {}

    private function getAlbumForSpotifySearchItem($item)
    {
        //Query for Album and if no album exists, save album data
        //$album = $this->em->getRepository('AppBundle:Album')->findOneBy(array('spotifyId' => $item['id']));
        //if (!$album) {
            $album = $this->saveAlbumData($item);
        //}

        return $album;
    }

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

        $album->setSpotifyId($item['id']);
        $album->setSpotifyUrl($externalUrls['spotify']);
        $album->setName($item['name']);

        $album->setAlbumType($item['album_type']);
        $album->setHref($item['href']);
        $album->setType($item['type']);
        $album->setUri($item['uri']);


        //$this->em->persist($album);
        //$this->em->flush($album);

        //Save Images for Album
        $this->saveAlbumImages($item, $album);

        return $album;
    }

    private function saveAlbumImages($item, $album)
    {
        $images = [];

        foreach ($item['images'] as $image) {

            $albumImage = new AlbumImage();

            $albumImage->setAlbum($album);
            $albumImage->setHeight($image['height']);
            $albumImage->setWidth($image['width']);
            $albumImage->setUrl($image['url']);

            //$this->em->persist($albumImage);
            //$this->em->persist($album);

            //$this->em->flush();

            $images[] = $albumImage;
        }

        return $images;
    }
}