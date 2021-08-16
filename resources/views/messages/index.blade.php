@extends('messages.layout')

@section('title', 'Tous les messages')

@section('content')
@parent
    <livewire:message.liste>
@endsection
