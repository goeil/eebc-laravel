@extends('layouts.template')
@section('title', 'Voici une page')

@section('content')

@hasSection('top-image')
  <img class="top-image" src="@yield('top-image')" style="width:100%">
@else
  <div style="height: 180px; bg-color: white">&nbsp;</div>
@endif

@endsection
