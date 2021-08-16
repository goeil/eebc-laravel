@extends('articles.layout')

@section('title', 'Tous les articles')

@section('content')
@parent
    <div class="container">
        <h1 class="">Liste des articles</h6>
        @auth
        <a href="{{ route('articles.edit') }}" class="btn btn-success">
             <i class="bi bi-file-plus"></i> Créer un article
        </a>
        @endauth

        @if ($message = Session::get('success'))
          <div class="alert alert-success">
            <p>{{ $message }}</p>
          </div>
        @endif

        <table class="table">
          <thead>
          <tr class="fw-bold">
            <th scope="col">ID</th>
            <th scope="col">Titre</th>
            <th scope="col">Sous-titre</th>
            <th scope="col">Auteur</th>
            <th scope="col">Publication</th>
            <th scope="col">Mort</th>
              @auth
            <th scope="col">&nbsp;</th>
              @endauth
          </tr>
          </thead>
          @foreach ($articles as $article)
          <tbody>
            <tr>
              <th class="">{{ $article->id }}</th>
              <td><strong><a href="{{ route('object', ['slug' => $article->slug]) }}">
                 {{ $article->titre }}</a><strong></td>
              <td>{{ $article->soustitre }}</td>
              <td>{{ $article->auteur->prenomNom() }}</td>
              <td>{{ Date::parse($article->debutpublication)->format('d F Y') }}</td>
              <td>{{ Date::parse($article->finpublication)->format('d F Y') }}</td>
              @auth
              <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('articles.edit', $article) }}" class="btn
                           btn-primary btn-sm"><i class="bi-pencil"></i></a>
                <a href="{{ route('articles.delete', $article) }}" class="btn
                           btn-danger btn-sm"><i class="bi-x"></i></a>
                </div>
              </td>
              @endauth
            </tr>
          @endforeach
        </tbody>
        </table>
    </div>
@endsection
