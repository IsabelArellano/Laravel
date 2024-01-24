@extends ('layouts.layout')
@section('title', 'number of fimls')
@section('content')


<section class="container-fluid content py-5 mt-5">
    <h1 class="mb-5">{{$title}}</h1>

    @if(empty($films))
    <FONT COLOR="red">We couldn't find the movie</FONT>

    @else
        <div>
            <p>The total numer of films are: {{$films}}</p>
        </div>
    
    @endif
</section>
@endsection