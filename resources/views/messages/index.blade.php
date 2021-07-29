@extends('messages.layout')

@section('title', 'Tous les messages')

@section('content')
@parent
    <div class="container">
        <h1 class="">Liste des messages</h6>
        @auth
        <a href="{{ route('messages.edit') }}" class="btn btn-success">
             <i class="bi bi-file-plus"></i> Créer un message
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
            <td class="fw-bold">Auteur</td>
            <td class="fw-bold">Publication</td>
            <td>&nbsp;</td>
          </th>
          @foreach ($messages as $message)
            <tr>
            <td>&nbsp;</td>
              <td><strong><a href="{{ route('object', ['slug' => $message->slug]) }}">
                 {{ $message->titre }}</a><strong></td>
              <td>{{ $message->auteur->prenomNom() }}
              <td>{{ Date::parse($message->date)->format('d F Y') }}
              @auth
              <td>
                <a href="{{ route('messages.edit', $message) }}" class="btn
                           btn-primary"><i class="bi-pencil"></i></a>
              </td>
              @endauth
            </tr>
          @endforeach
        </table>
    </div>
@endsection
