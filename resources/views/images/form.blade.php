@extends('layouts.cms')

@section('content')
      <div class="row">
        <div class="col-lg-12 margin-tb">
          <div class="pull-left mb-2">
            <h2>{{ $titrepage }}</h2>
          </div>
          <div class="pull-right">
            <a class="btn btn-secondary" href="{{ route('images.index') }}"> Back</a>
          </div>
        </div>
      </div>
      @if(session('status'))
      <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
      </div>
      @endif
      <form action="{{ isset($image) 
                          ? route('images.update', $image->id)
                          : route('images.store') }}" 
          method="POST" enctype="multipart/form-data">
      @csrf
      @if(isset($image))
        @method('PUT')
      @endif
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" class="form-control" 
            value="{{ isset($image) ? old('name', $image->name) : ''}}"
            placeholder="Name">
          <div class="form-text">Le nom de l'image pour vous</div>
            @error('name')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="name" class="form-label">Image file</label>
          <input type="file" name="image" class="form-control" 
            value="{{ isset($image) ? old('image', $image->image) : ''}}"
            placeholder="Organisateur de l'évènement">
          <div class="form-text">Fichier à téléverser</div>

            @error('image')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary ml-3">Submit</button>
    </form>

      @if(isset($image))
          <img src="{{ $image->getFirstMediaUrl('images') }}" 
           alt="no image" max-width="100" max-height="200">
      @endif

@endsection
