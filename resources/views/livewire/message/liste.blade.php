<div class="container">
    <div class="d-flex align-items-center">
        <h2 class="flex-grow-1">Liste des messages</h2>
          <div class="input-group mx-4 w-25">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control" 
                   wire:model="recherche"
                   size="2"
                   placeholder="Rechercher…" aria-label="Recherche" 
                   aria-describedby="Recherche"/>
          </div>

        @auth
        <a href="{{ route('messages.edit') }}" class="btn btn-success btn-sm">
             <i class="bi bi-file-plus"></i> Créer
        </a>
        @endauth
    </div>
        @if ($message = Session::get('success'))
          <div class="alert alert-success">
            <p>{{ $message }}</p>
          </div>
        @endif

        <table class="table table-striped">
          <thead>
          <tr class="fw-bold">
              @auth
            <th scope="col">ID</th>
              @endauth
            <th scope="col">Titre</th>
            <th scope="col">Auteur</th>
            <th scope="col">Publication</th>
              @auth
            <th scope="col">&nbsp;</th>
              @endauth
          </tr>
          </thead>
          <tbody>
          @foreach ($messages as $message)
            <tr>
              @auth
              <th class="">{{ $message->id }}</th>
              @endauth
              <td><strong><a href="{{ route('object', ['slug' => $message->slug]) }}">
                 {{ $message->titre }}</a><strong></td>
              <td>{{ $message->auteur->prenomNom() }}</td>
              <td>{{ Date::parse($message->date)->format('d F Y') }}
              @auth
              <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('messages.edit', $message) }}" class="btn
                           btn-primary btn-sm"><i class="bi-pencil"></i></a>
                <a 
                    onclick="return confirm('Êtes-vous sûr ?');"
                    href="{{ route('messages.delete', $message) }}" class="btn
                           btn-danger btn-sm"><i class="bi-trash"></i></a>
                </div>
              </td>
              @endauth
            </tr>
          @endforeach
        </tbody>
        </table>

    {{ $messages->links() }}
</div>
