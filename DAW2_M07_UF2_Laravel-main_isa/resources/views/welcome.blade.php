@extends('layouts.layout')
@section('title', 'Lista de peliculas')
@section('content')

<section class="py-5 text-center" style="background-color: black;">
    <h2 class="mt-5"  style="color:white">LIST OF FILMS</h2>
    <ul class="mt-3 list-group list-group-flush" style="color:aquamarine">
        <li><a href=/filmout/oldFilms class="list-group-item list-group-item-action list-group-item-info" > Old Films</a></li>
        <li><a href=/filmout/newFilms class="list-group-item list-group-item-action list-group-item-info"> New Films</a></li>
        <li><a href=/filmout/films class="list-group-item list-group-item-action list-group-item-info"> Films</a></li>
        <li><a href=/filmout/filmsByYear class="list-group-item list-group-item-action list-group-item-info"> Films by year</a></li>
        <li><a href=/filmout/filmsByGenre class="list-group-item list-group-item-action list-group-item-info"> Films by genre</a></li>
        <li><a href=/filmout/sortFilms class="list-group-item list-group-item-action list-group-item-info"> Films by year from new to old</a></li>
        <li><a href=/filmout/countFilms class="list-group-item list-group-item-action list-group-item-info"> Total number of films</a></li>
        <style>
            ul.list-group li a {
                color: black; /* Cambia el color del texto */
                background-color: red; /* Cambia el color de fondo */
                display: block;
                text-decoration: none;
                padding: 10px;
            }

            ul.list-group li a:hover {
                background-color: white; /* Cambia el color de fondo al pasar el cursor por encima */
            }
        </style>
    </ul>

    <!--New Form where create new films-->
    <form class="mt-5" action="{{route('createFilm')}}" method="post" id="formularioPelicula">
        {{csrf_field()}}
        <h2 class="mb-3" style="color:white">ADD FILMS</h2>
        <label  style="color:white"for="nombre">Name:</label>
        <input  style="color:black"type="text" id="nombre" name="name" style="background: white;border: none;border-bottom: 1px solid black;" required>
        <br>
        <label  style="color:white"for="ano">Year:</label>
        <input  style="color:black"type="text" id="ano" name="year" style="background: white;border: none;border-bottom: 1px solid black;" required>
        <br>
        <label  style="color:white" for="genero">Genre:</label>
        <input  style="color:black"type="text" id="genero" name="genre" style="background: white;border: none;border-bottom: 1px solid black;" required>
        <br>
        <label  style="color:white"for="pais">Country:</label>
        <input  style="color:black"type="text" id="pais" name="country" style="background: white;border: none;border-bottom: 1px solid black;" required>
        <br>
        <label  style="color:white"for="duracion">Duration:</label>
        <input  style="color:black"type="text" id="duracion" name="duration" style="background: white;border: none;border-bottom: 1px solid black;" required>
        <br>
        <label  style="color:white"for="img_url">URL Image:</label>
        <input  style="color:black"type="text" id="img_url" name="img_url" style="background: white;border: none;border-bottom: 1px solid black;">
        <br>
        <input  style="color:white"type="submit" class="btn btn-outline-info" value="Enviar">
    </form>
</section>

@endsection