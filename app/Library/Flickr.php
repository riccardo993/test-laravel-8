<?php
namespace App\Library;

use App\Contracts\MediaContract;
use App\Models\Media;
use Carbon\Carbon;

class Flickr implements MediaContract
{
    const BASE_URI = "https://api.flickr.com/services/feeds/";

    protected $client;

    public function __construct()
    {

        $this->client = new \GuzzleHttp\Client(
            [
                'base_uri' => self::BASE_URI,
                'debug' => 0
            ]
        );
    }

    public function sync() : bool
    {
        $array = $this->getJson();

        if(is_null($array))
        {
            return false;
        }

        foreach($array['items'] as $el)
        {
            $this->storeObject($el);
        }

        return true;
    }

    protected function getJson()
    {
        try{
            $querystring['format'] = 'json';
            $querystring['lang'] = 'en-US';
            $querystring['nojsoncallback'] = 1;

            $response = $this->client->get('photos_public.gne', [
                'query' => $querystring
            ]);

            return json_decode($response->getBody()->getContents(), 1);

        }catch(\Exception $e){

            return null;
        }
    }

    protected function storeObject($object)
    {
        $date_taken = new Carbon($object['date_taken']);
        $published = new Carbon($object['published']);

        $title = trim($object['title']);

        $media = new Media;
        $media->title = empty($title) ? 'Senza titolo' : $title;
        $media->link = $object['link'];
        $media->media = $object['media']['m'];
        $media->taken_at = $date_taken;
        $media->description = $object['description'];
        $media->published_at = $published;
        $media->author = $object['author'];
        $media->author_id = $object['author_id'];
        $media->tags = $object['tags'] ?? null;
        $media->save();
    }
}
