<?php /**@var $posts \App\Entities\Post[] */ ?>

@foreach($posts as $post)
    <h1> {{$post->getHeader()}} </h1>
    <p> {{$post->getContent()}} </p>
    <a href="#"> {{$post->getFile()}} </a>
    <p> {{$post->getDate()}} </p>
    <p> {{$post->getAuthorName()}} </p>
@endforeach


