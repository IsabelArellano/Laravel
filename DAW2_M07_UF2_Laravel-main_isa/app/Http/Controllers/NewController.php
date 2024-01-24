<?php
namespace App\Http\Controllers; 
use Illuminate\Support\Facades\Storage;

class NewController extends Controller{

    public static function readFilms(): array{
        $films = Storage::json('/public/films.json'); 
        return $films;
    }

    public function listCountFilms($year = null, $genre=null){
        $films = FilmController::readFilms(); 
        $filteredFilms = array_filter($films,function ($film) use ($year,$genre){
            return (is_null($year) || $film['year'] == $year) && (is_null($genre) || strtolower($film['genre']) == strtolower($genre));
        });
        $totalFilmCount = count($filteredFilms);
    
        return "Number of films: $totalFilmCount";
        
    }
}


?>