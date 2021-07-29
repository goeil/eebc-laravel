@extends('layouts.cms')

@section('top-image', asset('images/cms-top.png'))

@section('title', 'CMS EEBC - Édition d\'un évènement')

@section('content')
@parent
    <div class="container">
        <h1 class="">{{ $titrepage }}</h1>
        <a class="btn btn-primary" href="{{ route('evenements.index') }}"> Back</a>
      @if(session('status'))
      <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
      </div>
      @endif

      <livewire:evenement.edit :evenement="$evenement">
    </div>
@endsection
