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
      <form action="{{ isset($evenement) 
                          ? route('evenements.update', $evenement->id)
                          : route('evenements.store') }}" 
          method="POST" enctype="multipart/form-data">
      @csrf
      @if(isset($evenement))
        @method('PUT')
      @endif

        <div class="mb-3">
          <label for="titre" class="form-label">Titre</label>
          <input type="text" name="titre" class="form-control" 
            value="{{ isset($evenement) ? old('titre', $evenement->titre) : ''}}"
            placeholder="Titre de l'évènement">
            @error('titre')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="horaire" class="form-label">Horaire</label>
          <input type="text" name="horaire" class="form-control" 
            value="{{ isset($evenement) ? old('horaire', $evenement->horaire) : ''}}"
            placeholder="Horaire de l'évènement">
            @error('horaire')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <input type="text" name="description" class="form-control" 
            value="{{ isset($evenement) ? old('description', $evenement->description) : ''}}"
            placeholder="Description de l'évènement">
            @error('description')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="type" class="form-label">Type</label>
          <input type="text" name="type" class="form-control" 
            value="{{ isset($evenement) ? old('type', $evenement->type) : ''}}"
            placeholder="Type d'évènement">
            @error('type')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="organisateur" class="form-label">Organisateur</label>
          <input type="text" name="organisateur" class="form-control" 
            value="{{ isset($evenement) ? old('organisateur', $evenement->organisateur) : ''}}"
            placeholder="Organisateur de l'évènement">
            @error('organisateur')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="lieu" class="form-label">Lieu</label>
          <input type="text" name="lieu" class="form-control" 
            value="{{ isset($evenement) ? old('lieu', $evenement->lieu) : ''}}"
            placeholder="Lieu de l'évènement">
            @error('lieu')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
          @if(isset($evenement))
          <div class="m-2">
            <img src="{{ $evenement->getFirstMediaUrl('illustration', 'thumb') }}" 
           alt="no image" max-width="100" max-height="200">
           </div>
          @endif
          <label for="illustration" class="form-label">Illustration</label>
          <input type="file" name="illustration" class="form-control" 
            value="{{ isset($evenement) ? old('illustration', $evenement->illustration) : ''}}"
            placeholder="Illustration de l'évènement">
          <div class="form-text">Fichier à téléverser</div>

            @error('illustration')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary ml-3">Submit</button>
      </div>
    </form>
  </body>
</html>
@endsection
