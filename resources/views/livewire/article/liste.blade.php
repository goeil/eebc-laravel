<div class="container">
    <div class="d-flex align-items-center">
        <h2 class="flex-grow-1">Liste des articles</h2>
        @auth
          <div class="input-group mx-4 w-25">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control" 
                   wire:model="recherche"
                   size="2"
                   placeholder="Rechercher…" aria-label="Recherche" 
                   aria-describedby="Recherche"/>
          </div>

        <a href="{{ route('articles.edit') }}" class="btn btn-success btn-sm">
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
            <th scope="col">Sous-titre</th>
            <th scope="col">Auteur</th>
            <th scope="col">Publication</th>
            <th scope="col">Mort</th>
              @auth
            <th scope="col">&nbsp;</th>
              @endauth
          </tr>
          </thead>
          <tbody>
          @foreach ($articles as $article)
            <tr>
              <th class="">{{ $article->id }}</th>
              <td><strong><a href="{{ route('object', ['slug' => $article->slug]) }}">
                 {{ $article->titre }}</a><strong></td>
              <td>{{ $article->soustitre }}</td>
              <td>{{ $article->auteur->prenomNom() }}</td>
              <td>{{ Date::parse($article->debutpublication)->format('d F Y') }}</td>
              <td>{{ Date::parse($article->finpublication)->format('d F Y') }}</td>
              @auth
              <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('articles.edit', $article) }}" class="btn
                           btn-primary btn-sm"><i class="bi-pencil"></i></a>
                <a 
                    onclick="return confirm('Êtes-vous sûr ?');"
                    href="{{ route('articles.delete', $article) }}" class="btn
                           btn-danger btn-sm"><i class="bi-trash"></i></a>
                </div>
              </td>
              @endauth
            </tr>
          @endforeach
        </tbody>
        </table>

    {{ $articles->links() }}
</div>
