<?php

use App\Collectors\Extractors\Dood;
use App\Collectors\Extractors\Mixdrop;
use App\Collectors\Helpers\encoders\Encoder;
use App\Collectors\ProvidersCollector;
use App\Collectors\Scrapers\Direct\Akwam;
use App\Collectors\Scrapers\Direct\Dbgo;
use App\Collectors\Scrapers\Direct\FaselApi;
use App\Collectors\Scrapers\Direct\Faselhd;
use App\Collectors\Scrapers\Direct\Loklok;
use App\Collectors\Scrapers\Direct\Rezka;
use App\Collectors\Scrapers\Direct\RStreamAPI;
use App\Collectors\Scrapers\Indirect\Allmoviesforyou;
use App\Collectors\Scrapers\Indirect\Cineb;
use App\Collectors\Scrapers\Indirect\Cinecalidad;
use App\Collectors\Scrapers\Indirect\Cmovies;
use App\Collectors\Scrapers\Indirect\Filmix;
use App\Collectors\Scrapers\Indirect\Fluxcedene;
use App\Collectors\Scrapers\Indirect\Fmovies;
use App\Collectors\Scrapers\Indirect\Goku;
use App\Collectors\Scrapers\Indirect\Movies123;
use App\Collectors\Scrapers\Indirect\Onionflix;
use App\Collectors\Scrapers\Indirect\Series9;
use App\Collectors\Scrapers\Indirect\Xcine;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SubtitlesController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SettingsController;
use App\Models\Genre;
use App\Models\Movie\Movie;
use App\Models\TmdbApi\Movie as TmdbApiMovie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::middleware(['guest'])->group(function () {
            Route::get("register", [RegisterController::class, 'show'])->name('register');
            Route::post("register", [RegisterController::class, 'createUser'])->name('register');
            Route::get("login", [LoginController::class, 'show'])->name('login');
            Route::post("login", [LoginController::class, 'login'])->name('login');
        });

        Route::middleware(['auth'])->group(function () {
            Route::get("logout", [LogoutController::class, "logout"])->name('logout');
            Route::get('profile', [ProfileController::class, 'show'])->name('profile');
            Route::get('settings', [SettingsController::class, 'show'])->name('settings');
            Route::post('settings/update', [SettingsController::class, 'updateUserInfo'])->name('update_settings');
            Route::get('notifications', [NotificationController::class, 'index'])->name('notifications');
        });

        Route::get('/', [HomeController::class, 'index'])->name('index');

        Route::get("genres", [CategoryController::class, "index"])->name('genres');
        Route::get("genre/{genre}", [CategoryController::class, "show"])->name('genre.show');

        Route::get("actors", [PersonController::class, "index"])->name('persons');
        Route::get("actor/{person}", [PersonController::class, "show"])->name('person.show');

        Route::get("collections", [CollectionController::class, "index"])->name('collections');
        Route::get("collection/{collection}", [CollectionController::class, "show"])
            ->name('genre.collection.show');


        Route::get("movies", [MovieController::class, "index"])->name('movie.index');
        Route::get("movie/{movie}", [MovieController::class, "show"])->name('movie.show');
        Route::get("movie/{movie}/trailer", [MovieController::class, "showTrailerModal"])
            ->name('movie.trailer');

        Route::get("movie/{movie}/report", [MovieController::class, "showReportModal"])
            ->name('movie.report');
        Route::post("movie/{movie}/report", [MovieController::class, "report"])
            ->name('movie.report');

        Route::get("embed/movie", [MovieController::class, "embed"])->name('movie.embed');

        Route::get("playlist/{path}", [PlaylistController::class, "servePlaylistLocalFile"])
            ->name('playlist.serve');
        Route::post("playlist-report/movie", [PlaylistController::class, "reportMoviePlaylist"])->name('report_playlist.movie');
        Route::post("playlist-report/episode", [PlaylistController::class, "reportEpisodePlaylist"])->name('report_playlist.episode');

        Route::get("subtitle/{path}", [SubtitlesController::class, "serveSubtitleLocalFile"])
            ->name('subtitle.serve');

        Route::get("series", [SerieController::class, "index"])->name('serie.index');
        Route::get("serie/{serie}", [SerieController::class, "show"])->name('serie.show');


        Route::get("serie/{serie}/s/{season}/e/{number}", [EpisodeController::class, "show"])->name('episode.show');
        Route::get("serie/{serie}/s/{season}/e/{number}/report", [EpisodeController::class, "showReportModal"])
            ->name('episode.report');
        Route::post("serie/{serie}/s/{season}/e/{number}/report", [EpisodeController::class, "report"])
            ->name('episode.report');
        Route::get("embed/episode", [EpisodeController::class, "embed"])->name('episode.embed');


        Route::post("search/suggestions", [SearchController::class, "searchSuggestions"])->name('search.suggestions');

        Route::prefix('ajax')->group(function () {
            Route::get('notifications', function () {
                return [];
            });
            Route::get("posts", function () {
                return [];
            });
            Route::get("follow", function () {
                return [];
            });
            Route::get("embed", function () {
                return [];
            });
            Route::get("savecollection", function () {
                return [];
            });
            Route::get("reaction", function () {
                return [];
            });
            Route::get("comments", function () {
                return [];
            });
            Route::get("post/{id}", function () {
                return [];
            });
            Route::get('delete/avatar', function () {
                return true;
            });
        });
    }
);



Route::view('explore', 'explore');
Route::view('trends', 'trends');

Route::view('discussion', 'discussion.index');
Route::view('discussion/{id}', 'discussion.show');




Route::get('test', function () {
    // $en = new Encoder();
    // return $en->html_encoder(view('test'));
    // https://kinogo.biz/
    // https://hdrezka.re/main.html
    // https://gidonline.io/
    // https://filmix.ac/
    // http://seasonvar.ru/

    // HttpResponse<String> response = Unirest.get("https://getsuperembed.link/?video_id=" + showImdb.getImdb_id() +"&season=" + tvSeasons.get(0).getSeason_number() + "&episode=" + tvEpisodes.get(0).getEpisode_number()).asString();
	// 					movie.getTvShows().setMovieLink("https://2embed.org/embed/series?imdb=" + showImdb.getImdb_id() + "&s=" + tvSeasons.get(0).getSeason_number() + "&e=" + tvEpisodes.get(0).getEpisode_number());
	// 					movie.getTvShows().setMovieLink2("https://imdbembed.xyz/tv/imdb/"+showImdb.getImdb_id()+"-" +tvSeasons.get(0).getSeason_number()+"-" + tvEpisodes.get(0).getEpisode_number());
	// 					movie.getTvShows().setMovieLink3(response.getBody());
	// 					movie.getTvShows().setMovieLink4("https://v2.vidsrc.me/embed/" + showImdb.getImdb_id() + "/" + tvSeasons.get(0).getSeason_number()+"-" + tvEpisodes.get(0).getEpisode_number());
	// 					movie.getTvShows().setMovieLink5("https://gomostream.com/show/"+showImdb.getImdb_id()+"/" +tvSeasons.get(0).getSeason_number()+"-" + tvEpisodes.get(0).getEpisode_number());
	// 					movie.getTvShows().setMovieLink6("https://w2.yesmovies123.me/se_player.php?video_id=" + showImdb.getImdb_id() + "&s=" + tvSeasons.get(0).getSeason_number() + "&e=" + tvEpisodes.get(0).getEpisode_number());
	// 					model.addAttribute("imdbId",  showImdb.getImdb_id());

    $movie = [
        'type' => 'movie',
        'year' => 2008,
        'text' => 'the dark knight',
        'text_spanish' => 'noche violenta',
        'tmdb_id' => 155,
        'imdb_id' => 'tt0468569'
    ];

    $serie = [
        'type' => 'tv',
        'year' => 2011,
        'text' => 'Breaking Bad',
        'text_spanish' => 'juego de tronos',
        'season' => 4,
        'episode' => 1,
        'tmdb_id' => 1399,
        'imdb_id' => 'tt0944947'
    ];

    // https://dl.opensubtitles.org/en/download/src-api/vrf-19cc0c57/filead/1957440970.gz
    // https://dl.opensubtitles.org/en/download/src-api/vrf-19ea0c60/filead/1951899391.gz

    $link = "https://dl.opensubtitles.org/en/download/src-api/vrf-19cc0c57/filead/1957440970.gz";
    //$link = "https://dl.opensubtitles.org/en/download/src-api/vrf-19ea0c60/filead/1951899391.gz";


    // Fluxcedene 5
    // Cmovies 4 +  Movies123 8 + Series9 => same but (cmovies + Series9) better
    // Fmovies 6
    // cinedb 2
    // goku 7
    // allmovies 1
    // Onionflix 9
    // Cinecalidad 3

    // winners

    // (Series9 + Cmovies + Movies123)
    // Fluxcedene
    // (Cineb + Fmovies)


    // $mixdrop = "https://dood.yt/e/kqtq96e4afxf";

    // $mix = Dood::getVideo($mixdrop);

    // dd($mix);

    $fasel = FaselApi::search($serie);

    dd($fasel);


    $pc = new ProvidersCollector();
    $result = $pc->collect(Fmovies::class, $movie);
    dd($result, $pc);

    // cacluate the time for each one
    $start = microtime(true);
    $Fluxcedene = Filmix::search($movie);
    $time_elapsed_secs[] = microtime(true) - $start;

    $start = microtime(true);
    $Fmovies = Fmovies::search($movie);
    $time_elapsed_secs[] = microtime(true) - $start;

    $start = microtime(true);
    $cinedb = Cineb::search($movie);
    $time_elapsed_secs[] = microtime(true) - $start;


    dd([
        'Fluxcedene' => $Fluxcedene,
        'Fmovies' => $Fmovies,
        'cinedb' => $cinedb,
        'time_elapsed_secs' => $time_elapsed_secs
    ]);
});
