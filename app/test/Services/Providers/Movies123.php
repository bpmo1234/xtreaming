<?php

namespace App\Services\Providers;

use App\Services\Helpers\JaroWinkler;
use Illuminate\Support\Facades\Http;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;

class Movies123
{
    protected const DOMAIN = 'https://123moviesfree.so';
    protected const API = 'https://123moviesfree.so/ajax';
    public const PROVIDER = "USERIES9";

    public static function searchUrl($text)
    {
        return self::API . '/suggest_search?keyword=' . urlencode($text);
    }

    public static function search($text, $type = "movie", $year = null, $season = null, $episode = null)
    {
        // text shoudl be in spanish -----------------------------------------------
        $html = Http::withHeaders([
            'referer' =>    self::DOMAIN,
            'x-requested-with' => 'XMLHttpRequest'
        ])->get(self::searchUrl($text))->json()['content'];

        $crawler = new Crawler();
        $crawler->addHTMLContent($html);

        $data = $crawler->filter('.ss-title')->each(function ($el) use ($text, $type, $season) {
            $title = $el->text('');
            $similraty = null;
            if ($type == 'tv') {
                $tv_title = ucwords($text) . ' - Season ' . $season;
                $similraty = (new JaroWinkler())->compare($title, $tv_title);
            } else {
                $similraty = (new JaroWinkler())->compare($title, $text);
            }
            $href = $el->attr('href');
            $href = str_replace(self::DOMAIN, '', $href);
            $href = self::DOMAIN . $href . "/watching.html";
            return [
                'title' => $title,
                'href' => $href,
                'similraty' => $similraty,
            ];
        });

        $show = collect($data)
            ->filter()
            ->sortByDesc('similraty')
            ->first();

        if (!$show)
            return null;


        if ($show) {
            $client = new_http_client();
            $crawler = new HttpBrowser($client);
            $content = $crawler->request('GET', $show['href']);
            if ($type == 'movie') {
                $servers = $content->filter('div#list-eps .les-content a')->each(function ($server) {
                    $player = $server->attr('player-data');
                    if ($player[0] == "/")
                        $player = "https:" . $player;
                    return $player;
                });
                $servers = array_values(array_filter($servers));
                return $servers;
            } else {
                $servers = $content->filter('div#list-eps .les-content a')->each(function ($server) use ($episode) {
                    $ep_number = $server->attr('episode-data');
                    $player = $server->attr('player-data');
                    if ($player[0] == "/")
                        $player = "https:" . $player;
                    if ($ep_number == $episode)
                        return $player;
                    return null;
                });
                $servers = array_values(array_filter($servers));
                return $servers;
            }
        }
        return null;
    }
}
