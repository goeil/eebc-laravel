@extends('evenements.layout')

@section('title', 'Tous les évènements')

@section('content')
@parent
    <livewire:evenement.liste>

    {{--foreach…<livewire:evenement.showline :evenement="$evenement">--}}
@endsection
