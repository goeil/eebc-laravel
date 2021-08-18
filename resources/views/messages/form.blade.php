@extends('layouts.cms')

@section('top-image', asset('img/cms-top.png'))

@section('title', 'CMS EEBC - Édition d\'un message')

@section('content')
@parent
    <div class="container">
        <h1 class="">{{ $titrepage }}</h1>
        <a class="btn btn-primary" href="{{ route('messages.index') }}"> Back</a>
      @if(session('status'))
      <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
      </div>
      @endif

      <livewire:message.edit :message="$message">
    </div>
@endsection
