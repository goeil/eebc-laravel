  <form wire:submit.prevent="submit">

      <!-- titre -->
      <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <div class="row">
          <div class="col-md-7">
            <input type="text" name="titre" class="form-control" 
            wire:model="message.titre"
            wire:keyup="adjustSlug"
            placeholder="Titre">
            <div class="form-text">Votre titre</div>
            @error('message.titre')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
          </div>
          <div x-data="{ open: true }" class="col-md-5">
            <div class="input-group input-group-sm mb-3">
                <a class="btn btn-secondary btn-sm" @click="open = ! open">Modifier</a>
                <input type="text" name="slug" class="form-control"
                  x-bind:disabled="open"
                  wire:model="message.slug"
                  wire:keyup="validateSlug"
                  placeholder="Slug">
            </div>
              <div class="form-text">Identifiant unique</div>
                @error('message.slug')
                  <div class="alert alert-danger mt-1 mb-1">{!! $message !!}</div>
                @enderror
          </div>
        </div>
      </div>

      <!-- date de publication -->
      <div class="mb-3" wire:ignore>
        <label for="date" class="form-label">Date</label>
            <input type="text" name="horaire" class="form-control" 
            wire:model.lazy="message.date"
            id="dtpickerDate"
            placeholder="Date">
            <div class="form-text">Date à laquelle a été donné le message</div>
            @error('message.date')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
      </div>


      <!-- auteur -->
      <div class="mb-3">
        <label for="auteur" class="form-label">Auteur</label>
            <select name="type" class="form-control" 
            wire:model="auteur">
              @foreach($auteurs as $a)
              <option value="{!! $a->id !!}" wire:key="{{ $a->id }}"
              >{{ $a->prenomNom() }}</option>
              @endforeach
            </select>
            <div class="form-text">Celui qui a donné le message</div>
            @error('auteur')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
      </div>

      <!-- Lien externe -->
      <div class="mb-3">
        <label for="lien" class="form-label">Lien externe</label>
        <div class="row">
          <div class="col-md-7">
            <input type="text" name="lien" class="form-control" 
            wire:model="message.lien"
            placeholder="Lien (URL Youtube par exemple)">
            <div class="form-text">Lien pour écouter le message</div>
            @error('message.lien')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>

      <!-- description -->
      <div class="mb-3">
        <label for="message" class="form-label">Contenu</label>
            <textarea id="description" name="description" class="form-control" 
            wire:model="message.description" rows="13"
            placeholder="Votre message (format Markdown)">
            </textarea>
            <div class="form-text">Texte accompagnant le message</div>
            @error('message.description')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
      </div>


      <!-- livre biblique et référence -->
      <div class="mb-3">
        <label for="titre" class="form-label">Livre biblique</label>
        <div class="row">
          <div class="col-md-7">
            <select name="type" class="form-control" 
            wire:model="livrebiblique">
              <option value="-1" wire:key="-1">-- Pas de référence --</option>
              @foreach($livresbibliques as $l)
              <option value="{!! $l->id !!}" wire:key="{{ $l->id }}"
              >{{ $l->nom }}</option>
              @endforeach
            </select>
            <div class="form-text">Livre biblique</div>
            @error('livrebiblique')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-5">
            <div class="input-group input-group-sm mb-3">
                <input type="text" name="reference" class="form-control"
                  wire:model="message.reference"
                  placeholder="Chapitre:Versets">
            </div>
              <div class="form-text">Chapitre et versets</div>
                @error('message.reference')
                  <div class="alert alert-danger mt-1 mb-1">{!! $message !!}</div>
                @enderror
          </div>
        </div>
      </div>

      <!-- Durée -->
      <div class="mb-3">
        <label for="duree" class="form-label">Durée</label>
        <div class="row">
          <div class="col-md-7">
            <input type="text" name="titre" class="form-control" 
            wire:model="message.duree"
            placeholder="Durée en minutes">
            <div class="form-text">Durée du message</div>
            @error('message.duree')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
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
            @error('message.etiquettes')
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

    <button type="submit" class="btn btn-primary">Sauvegarder</button>
  </form>
</div>


@section('scripts')
@parent
    <script>
        // Initialise datepicker
        flatpickr('#dtpickerDate', {
            enableTime: false,
            dateFormat: 'Y-m-d',
            altFormat: "Y-m-d",
            altInput: true,
            inline: false,
            locale: "fr",
            defaultDate: @this.message.date,
            onChange: function(selectedDates, dateStr, instance) {
            }
        });

    </script>
@endsection
