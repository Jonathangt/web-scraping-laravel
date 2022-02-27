<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Exception;

class ScrapingController extends Controller
{
    public function scraping(Client $client){

       

        
        //$crawler->filter('article')->first()->html();
        //$crawler = $client->request('GET', "https://www.computrabajo.com.ec/trabajo-de-informatica?p=1");
        //$job =  $crawler->filter('article')->first()->html();
        for ($i=1; $i <=3; $i++) { 
            $crawler = $client->request('GET', "https://www.computrabajo.com.ec/trabajo-de-informatica?p=$i");
            $this->extractPosts($crawler);
        }

        return back();
    }

    public function extractPosts(Crawler $crawler){
        $crawler->filter('article')->each(function (Crawler $node) {
            $url_base = "https://www.computrabajo.com.ec";

            $title = $node->filter("[class='js-o-link fc_base']")->first()->text();
            $location = $node->filter("[class='fs16 fc_base mt5 mb10']")->first()->text();
            $description = $node->filter("[class='fc_aux t_word_wrap mb10 hide_m']")->first()->text();
            $url = $node->filter("[class='js-o-link fc_base']")->first()->attr('href');


            try {
                $post = new Post();
                $post->title = $title;
                $post->location = $location;
                $post->description = $description;
                $post->url = $url_base.$url;
                $post->is_published = false;
                $post->save();

                return response()->json(['msj' => 'OK'], 200);
            } catch (Exception $e) {
                return response()->json(['msj' => $e->getMessage()], 500);
            }     
        });

        
    }
}
