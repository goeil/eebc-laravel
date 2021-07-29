@extends('evenements.layout')

@section('title', 'Tous les évènements')

@section('content')
@parent
    <div class="container">
        <h1 class="">Liste des évènements</h6>
        @auth
        <a href="{{ route('evenements.edit') }}" class="btn btn-success"><i class="bi bi-file-plus"></i> Créer</a>
        @endauth

        @if ($message = Session::get('success'))
          <div class="alert alert-success">
            <p>{{ $message }}</p>
          </div>
        @endif

        @foreach ($evenements as $evenement)
          <livewire:evenement.showline :evenement="$evenement">
        @endforeach
    </div>
@endsection
