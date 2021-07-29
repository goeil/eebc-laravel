@extends('evenements.layout')

@section('content')
      <div class="row">
        <div class="col-lg-12 margin-tb">
          <div class="pull-left mb-2">
            <h2>{{ $titrepage }}</h2>
          </div>
          <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('evenements.index') }}"> Back</a>
          </div>
        </div>
      </div>
      @if(session('status'))
      <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
      </div>
      @endif

      <livewire:evenement.form />

  </body>
</html>
@endsection
