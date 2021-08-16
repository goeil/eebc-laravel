<div class="container">
    <div class="d-flex align-items-center">
        <h2 class="flex-grow-1">Liste des évènements</h2>
        @auth
          <div class="input-group mx-4 w-25">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control" 
                   wire:model="recherche"
                   size="2"
                   placeholder="Rechercher…" aria-label="Recherche" 
                   aria-describedby="Recherche"/>
          </div>

        <a href="{{ route('evenements.edit') }}" class="btn btn-success btn-sm">
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
            <th scope="col">ID</th>
            <th scope="col">Titre</th>
            <th scope="col">Horaire</th>
            <th scope="col">Type</th>
            <th scope="col">Lieu</th>
            <th scope="col">Organisateur</th>
              @auth
            <th scope="col">&nbsp;</th>
              @endauth
          </tr>
          </thead>
          <tbody>
          @foreach ($evenements as $evenement)
            <tr>
              <th class="">{{ $evenement->id }}</th>
              <td><strong><a href="{{ route('object', ['slug' => $evenement->slug]) }}">
                 {{ $evenement->titre }}</a><strong></td>

              <td>{{ Date::parse($evenement->horaire)->format('d F Y à H:i') }}</td>
              <td>{{ $evenement->type->nom }}</td>
              <td>{{ $evenement->lieu->nom }}</td>
              <td>{{ $evenement->organisateur->nom }}</td>
              @auth
              <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('evenements.edit', $evenement) }}" class="btn
                           btn-primary btn-sm"><i class="bi-pencil"></i></a>
                <a 
                    onclick="return confirm('Êtes-vous sûr ?');"
                    href="{{ route('evenements.delete', $evenement) }}" class="btn
                           btn-danger btn-sm"><i class="bi-trash"></i></a>
                </div>
              </td>
              @endauth
            </tr>
          @endforeach
        </tbody>
        </table>

    {{ $evenements->links() }}
</div>
