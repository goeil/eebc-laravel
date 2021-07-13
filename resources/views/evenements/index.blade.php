@extends('evenements.layout')

@section('content')
    <div class="row">
      <div class="col-lg-12 margin-tb">
        <div class="pull-left">
          <h2>Liste des évènements</h2>
        </div>
        <div class="pull-right mb-2">
          <a class="btn btn-success" href="{{ route('evenements.create') }}">Créer un évènement</a>
        </div>
        @lang('lang.welcome')
      </div>
    </div>
    @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div>
    @endif
    <table class="table table-bordered">
      <tr>
        <th>ID</th>
        <th>Illustr</th>
        <th>Titre</th>
        <th>Description</th>
        <th>Horaire</th>
        <th width="280px">Action</th>
      </tr>
      @foreach ($evenements as $evenement)
      <tr>
        <td>{{ $evenement->id }}</td>
        <td><img src="{{ $evenement->getMedia('illustration')->first()->getUrl('square') }}"></td>
        <td><a href = "{{ route('evenements.show', $evenement->id) }}"
             >{{ $evenement->titre }}</a></td>
        <td>{{ $evenement->description }}</td>
        <td>{{ $evenement->horaire }}</td>
        <td>
          <form action="{{ route('evenements.destroy',$evenement->id) }}" method="Post">
            <a class="btn btn-primary" href="{{
            route('evenements.edit',$evenement->id) }}">Éditer</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  {!! $evenements->links() !!}
@endsection
