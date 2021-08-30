
  <form wire:submit.prevent="submit">

      <!-- titre -->
      <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <div class="row">
          <div class="col-md-7">
            <input type="text" name="titre" class="form-control" 
            wire:model="article.titre"
            wire:keyup="adjustSlug"
            placeholder="Titre">
            <div class="form-text">Votre titre</div>
            @error('article.titre')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
          </div>
          <div x-data="{ open: true }" class="col-md-5">
            <div class="input-group input-group-sm mb-3">
                <a class="btn btn-secondary btn-sm" @click="open = ! open">Modifier</a>
                <input type="text" name="slug" class="form-control"
                  x-bind:disabled="open"
                  wire:model="article.slug"
                  wire:keyup="validateSlug"
                  placeholder="Slug">
            </div>
              <div class="form-text">Identifiant unique</div>
                @error('article.slug')
                  <div class="alert alert-danger mt-1 mb-1">{!! $message !!}</div>
                @enderror
          </div>
        </div>
      </div>

      <!-- sous-titre -->
      <div class="mb-3">
        <label for="soustitre" class="form-label">Sous-titre</label>
        <div class="row">
          <div class="col-md-7">
            <input type="text" name="titre" class="form-control" 
            wire:model="article.soustitre"
            placeholder="Sous-titre">
            <div class="form-text">Votre sous-titre</div>
            @error('article.soustitre')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>

      <!-- publication -->
      <div class="mb-3">
        <label for="auteur" class="form-label">Auteur</label>
            <select name="type" class="form-control" 
            wire:model="auteur">
              @foreach($auteurs as $a)
              <option value="{!! $a->id !!}" wire:key="{{ $a->id }}"
              >{{ $a->prenomNom() }}</option>
              @endforeach
            </select>
            <div class="form-text">L'auteur de l'article</div>
            @error('auteur')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
      </div>

      <!-- date de publication -->
      <div class="mb-3" wire:ignore>
        <label for="debutpublication" class="form-label">Jour de publication</label>
            <input type="text" name="horaire" class="form-control" 
            wire:model.lazy="article.debutpublication"
            id="dtpickerDebut"
            placeholder="Date">
            <div class="form-text">Jour de publication</div>
            @error('article.debutpublication')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
      </div>

      <!-- fin de publication -->
      <div class="mb-3" wire:ignore>
        <label for="finpublication" class="form-label">Fin de publication</label>
            <input type="text" name="horaire" class="form-control" 
            wire:model.lazy="article.finpublication"
            id="dtpickerFin"
            placeholder="Date">
            <div class="form-text">Fin de publication</div>
            @error('article.finpublication')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
      </div>

      <!-- contenu -->
      <div class="mb-3">
        <label for="article" class="form-label">Contenu</label>
            <textarea id="description" name="description" class="form-control" 
            wire:model="article.article" rows="13"
            placeholder="Votre article (format Markdown)">
            </textarea>
            <div class="form-text">L'article</div>
            @error('article.article')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
      </div>

      <!-- Étiquettes -->
      <div class="mb-3">
        <label for="etiquettes" class="form-label">Étiquettes</label>
        <div class="row">
          <div class="">
            <input type="text" name="titre" class="form-control" 
            wire:model="etiquettes"
            placeholder="Dieu, attachement, persévérance">
            <div class="form-text">Étiquettes séparées par des virgules</div>
            @error('etiquettes')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>

      <div class="mb-3">
        <label for="illustration" class="form-label">Illustration</label>

        <div class="row">
          <div class="col-md-8">
            <h5>Modifier l'illustration</h5>
            <input type="file" class="form-control" wire:model="newIllustration">
            <div class="form-text">Fichier à téléverser
            </div>
            @error('newillustration')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
          </div>
          @if ($newIllustration)
          <div class="col-md-4">
            <div wire:loading wire:target="newIllustration">Téléversement en cours…</div>
            <img class="border rounded float-start me-2" src="{{ $newIllustration->temporaryUrl() }}" width="150">
          </div>
          @elseif ($illustrationUrl)
          <div class="col-md-4">
            <img class="border rounded float-start me-2" src="{{ $illustrationUrl }}" width="150">
          </div>
          @endif

        </div>
      </div>
      <div class="mb-3">
        <label for="piecesjointes" class="form-label">Pièces jointes</label>

        <div class="row">
          <div class="col-md-8">
            <input type="file" class="form-control" 
            wire:model="newPiecejointe"
            >
            <div class="form-text">Fichier à téléverser
            </div>
            @error('newPiecejointe')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-4">
            <ul class="list-group">
              @if ($newPiecejointe)
                <div wire:loading wire:target="newPiecejointe">Téléversement en cours…</div>
                      <li class="list-group-item">
                         {{ $newPiecejointe->getClientOriginalName() }}
                         ({{ $newPiecejointe->getSize() }})
                      </li>
              @elseif ($piecejointeUrl)
                      <li class="list-group-item">
                         {{ $newPiecejointe }}
                      </li>
              @endif
            </ul>
          </div>

        </div>
      </div>

    <button type="submit" class="btn btn-primary">Sauvegarder</button>
  </form>
</div>


@section('scripts')
@parent
    <script>
        // Initialise datepicker
        flatpickr('#dtpickerDebut', {
            enableTime: false,
            dateFormat: 'Y-m-d',
            altFormat: "Y-m-d",
            altInput: true,
            inline: false,
            locale: "fr",
            defaultDate: @this.article.debutpublication,
            onChange: function(selectedDates, dateStr, instance) {
            }
        });
        flatpickr('#dtpickerFin', {
            enableTime: false,
            dateFormat: 'Y-m-d',
            altFormat: "Y-m-d",
            altInput: true,
            inline: false,
            locale: "fr",
            defaultDate: @this.article.finpublication,
            onChange: function(selectedDates, dateStr, instance) {
            }
        });

    </script>
@endsection
