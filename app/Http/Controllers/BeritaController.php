<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;


class BeritaController extends Controller
{
    public function index()
    {
        $client = new Client();
        $url = [
            'https://aceh.tribunnews.com/tag/aceh-jaya',
        ];

        $articles = [];

        foreach ($url as $url) {
            $crawler = $client->request('GET', $url);
            $crawler->filter('li.ptb15')->each(function ($node) use (&$articles) {

                $title = $node->filter('h3 >a ')->attr('title');
                $link = $node->filter('h3 >a ')->attr('href');
                $image = $node->filter('div.fr.mt3.pos_rel > a > img')->attr('src');
                $snippet = $node->filter('h4.grey2.pt5')->text();
                $date = $node->filter('div.grey.pt5 > span.grey')->text();
                $articles[] = [
                    'title' => $title,
                    'link' => $link,
                    'image' => $image,
                    'snippet' => $snippet,
                    'date' => $date
                ];
            });
        }

        $url1 = [
            'https://aceh.tribunnews.com/tag/calang'
        ];

        $articles2 = [];

        foreach ($url1 as $url) {
            $crawler = $client->request('GET', $url);
            $crawler->filter('li.ptb15')->each(function ($node) use (&$articles2) {

                $title = $node->filter('h3 >a ')->attr('title');
                $link = $node->filter('h3 >a ')->attr('href');
                $image = $node->filter('div.fr.mt3.pos_rel > a > img')->attr('src');
                $snippet = $node->filter('h4.grey2.pt5')->text();
                $date = $node->filter('div.grey.pt5 > span.grey')->text();
                $articles2[] = [
                    'title' => $title,
                    'link' => $link,
                    'image' => $image,
                    'snippet' => $snippet,
                    'date' => $date
                ];
            });
        }
        //   dd($articles2);
        return view('berita', ['articles' => $articles, 'articles2' => $articles2]);
    }
}
