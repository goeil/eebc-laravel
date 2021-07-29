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

        <table border>
          <th class="fw-bold">
            <td class="fw-bold">Titre</td>
            <td class="fw-bold">Sous-titre</td>
            <td class="fw-bold">Auteur</td>
            <td class="fw-bold">Publication</td>
            <td class="fw-bold">Mort</td>
            <td>&nbsp;</td>
          </th>
          @foreach ($articles as $article)
            <tr>
            <td>&nbsp;</td>
              <td><strong><a href="{{ route('object', ['slug' => $article->slug]) }}">
                 {{ $article->titre }}</a><strong></td>
              <td>{{ $article->soustitre }}</td>
              <td>{{ $article->auteur->prenomNom() }}
              <td>{{ Date::parse($article->debutpublication)->format('d F Y') }}
              <td>{{ Date::parse($article->finpublication)->format('d F Y') }}
              @auth
              <td>
                <a href="{{ route('articles.edit', $article) }}" class="btn
                           btn-primary"><i class="bi-pencil"></i></a>
              </td>
              @endauth
            </tr>
          @endforeach
        </table>
    </div>
@endsection
