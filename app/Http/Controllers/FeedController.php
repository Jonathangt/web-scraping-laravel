<?php

namespace App\Http\Controllers;

use App;
use URL;
use App\Models\Post;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function rssFeed(){
         // create new feed
        $feed = App::make("feed");


        // creating rss feed with our most recent 20 posts
       $posts = Post::where('is_published', true)->orderBy('updated_at', 'desc')->get();

       // set your feed's title, description, link, pubdate and language
       $feed->title = 'Your title';
       $feed->description = 'Your description';
       $feed->logo = 'http://yoursite.tld/logo.jpg';
       $feed->link = url('feed');
       $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
       $feed->pubdate = $posts[0]->created_at;
       $feed->lang = 'es';
       $feed->setShortening(true); // true or false
       $feed->setTextLimit(100); // maximum length of description text

       
       foreach ($posts as $post)
       {
           // set item's title, author, url, pubdate, description, content, enclosure (optional)*
           $feed->add(
                $post->title,
                $post->location,
                URL::to($post->url),
                $post->created,
                $post->description,
            );
       }



        // first param is the feed format
        // optional: second param is cache duration (value of 0 turns off caching)
        // optional: you can set custom cache key with 3rd param as string
        return $feed->render('atom');

        // to return your feed as a string set second param to -1
        // $xml = $feed->render('atom', -1);

    }
}
