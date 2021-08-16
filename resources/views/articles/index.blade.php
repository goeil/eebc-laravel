@extends('articles.layout')

@section('title', 'Tous les articles')

@section('content')
@parent
    <livewire:article.liste>
@endsection
