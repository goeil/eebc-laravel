@extends('layouts.cms')

@section('top-image', asset('img/cms-top.png'))

@section('title', 'CMS EEBC - Édition d\'un article')

@section('content')
@parent
    <div class="container">
        <h1 class="">{{ $titrepage }}</h1>
        <a class="btn btn-primary" href="{{ route('articles.index') }}"> Back</a>
      @if(session('status'))
      <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
      </div>
      @endif

      <livewire:article.edit :article="$article">
    </div>
@endsection
