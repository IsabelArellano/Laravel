<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FilmController extends Controller{
    /**
    * Read films from storage
    */
    public static function readFilms(): array {
        $films = Storage::json('/public/films.json');
        return $films;
    }
    /**
    * List films older than input year 
    * if year is not infomed 2000 year will be used as criteria
    */
    public function listOldFilms($year = null){        
        $old_films = [];
        if (is_null($year))
        $year = 2000;
    
        $title = "List of old films (before $year)";    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
        //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
    * List films younger than input year
    * if year is not infomed 2000 year will be used as criteria
    */
    public function listNewFilms($year = null){
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de pelis nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }
    /**
    * List all the films or filter by year or genre.
    */
    public function listFilms($year = null, $genre = null){
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if year and genre are null
        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year or genre 
        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year){
                $title = "Listado de todas las pelis filtrado por año";
                $films_filtered[] = $film;
            }else if((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)){
                $title = "Listado de todas las pelis filtrado por categoria";
                $films_filtered[] = $film;
            }else if(!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year){
                $title = "Listado de todas las pelis filtrado x categoria y año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
    /**
    * List films by year
    * if year is not infomed 1994 year will be used as criteria
    */
    public function listFilmsByYear($year = null){
        $filmsByYear = [];   
        $films = FilmController::readFilms();

        //if year is null
        if (is_null($year))
        $year = 1994;

        //list based on year
        foreach ($films as $film) {
            if (!is_null($year) && $film['year'] == $year){
                $title = "Listado de todas las pelis filtrado por año ( $year )";
                $filmsByYear[] = $film;
            }
        }
        return view('films.list', ["films" => $filmsByYear, "title" => $title]);
    }
    /**
    * List films by genre
    * if genre is not infomed Drama genre will be used as criteria
    */
    public function listFilmsByGenre($genre = null){
        $filmsByGenre = [];
        $films = FilmController::readFilms();

        //if genre is null
        if (is_null($genre))
        $genre = "Drama";

        //list based on genre
        foreach ($films as $film) {
            if (!is_null($genre) && strtolower($film['genre']) == strtolower($genre)){
                $title = "List of all the films by genre ( $genre )";
                $filmsByGenre[] = $film;
            }
        }
        return view('films.list', ["films" => $filmsByGenre, "title" => $title]);
    }

    /**
    * List films sorted by year descending from newest to oldest
    */
    public function listSortFilms($year = null){
    
        $sortFilms = [];   
        $films = FilmController::readFilms();

        if (!is_null($year)) {
            $title = "List of films by year from new to old films";
            foreach ($films as $film) {
                if ($film['year'] == $year) {
                    $sortFilms[] = $film;
                }
            }
        } else {
            $title = "List of films by year from new to old films";
            usort($films, function($a, $b) {
                return $b['year'] - $a['year'];
            });
            $sortFilms = $films;
        }
        return view('films.list', ["films" => $sortFilms, "title" => $title]);
    }
    /**
    * List total number of films
    */
    public function listCountFilms($year = null, $genre = null) {
        $films = FilmController::readFilms();
        $title = "Total number of films";
        $filteredFilms = array_filter($films, function ($film) use ($year, $genre) {
            return (is_null($year) || $film['year'] == $year) && (is_null($genre) || strtolower($film['genre']) == strtolower($genre));
        });
    
        $totalFilmCount = count($filteredFilms);
    
        return view('films.count', ["films" => $totalFilmCount, "title" => $title]);
    }

     /**
    * Check if film name exists
    */
    public function isFilm($nombre) {
        $films = FilmController::readFilms();
    
        foreach ($films as $film) {
            if ($film['name'] == $nombre) {
                return true;
            }
        }
    
        return false;
    }    

    public function createFilm(Request $request)
    {
        //Get the form data
        $name = $request->input('name');
        $year = $request->input('year');
        $genre = $request->input('genre');
        $country = $request->input('country');
        $duration = $request->input('duration');
        $img_url = $request->input('img_url');

        //Check if film name exists in films
        if ($this->isFilm($name)) {
            // Redirect to the main page with an error message
            return redirect('/')->with('error', 'This film already exists.');
        }

        $film = [
            'name' => $name,
            'year' => $year,
            'genre' => $genre,
            'country' => $country,
            'duration' => $duration,
            'img_url' => $img_url ?: '',
        ];

        $films = $this->readFilms();
        // Add film
        $films[] = $film;
        // Update films
        Storage::put('/public/films.json', json_encode($films));
        return $this->listFilms();
    }
}
