<div>

  <form wire:submit.prevent="submit">

    {{--<x-input-title wire:model="evenement.titre" />--}}

      <!-- titre -->
      <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <div class="row">
          <div class="col-md-7">
            <input type="text" name="titre" class="form-control" 
            wire:model="evenement.titre"
            wire:keyup="adjustSlug"
            placeholder="Titre">
            <div class="form-text">Votre titre</div>
            @error('evenement.titre')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
          </div>
          <div x-data="{ open: true }" class="col-md-5">
            <div class="input-group input-group-sm mb-3">
                <a class="btn btn-secondary btn-sm" @click="open = ! open">Modifier</a>
                <input type="text" name="slug" class="form-control"
                  x-bind:disabled="open"
                  wire:model="evenement.slug"
                  wire:keyup="validateSlug"
                  placeholder="Slug">
            </div>
              <div class="form-text">Identifiant unique</div>
                @error('evenement.slug')
                  <div class="alert alert-danger mt-1 mb-1">{!! $message !!}</div>
                @enderror
          </div>
        </div>
      </div>

      <!-- horaire -->
      <div class="mb-3" wire:ignore>
        <label for="horaire" class="form-label">Horaire</label>
            <input type="text" name="horaire" class="form-control" 
            wire:model.lazy="evenement.horaire"
            wire:change="adjustSlug"
            id="dtpickerHoraire"
            placeholder="Date et heure">
            <div class="form-text">Date et heure de l'évènement</div>
            @error('evenement.horaire')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
      </div>

      <!-- type -->
      <div class="mb-3">
        <label for="type" class="form-label">Type</label>
            <select name="type" class="form-control" 
            wire:model="type">
              @foreach($types as $t)
              <option value="{!! $t->id !!}" wire:key="{{ $t->id }}"
              >{{ $t->nom }}</option>
              @endforeach
            </select>
            <div class="form-text">Ce qui sert à décrire l'évènement</div>
            @error('type')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
      </div>

      <!-- lieu -->
      <div class="mb-3">
        <label for="lieu" class="form-label">Lieu</label>
            <select name="lieu" class="form-control" 
            wire:model.lazy="lieu">
              @foreach($lieux as $l)
              <option value="{{ $l->id }}">{{ $l->nom }}</option>
              @endforeach
            </select>
            <div class="form-text">Où se passe l'évènement</div>
            @error('lieu')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
      </div>
      <!-- organisateur -->
      <div class="mb-3">
        <label for="organisateur" class="form-label">Organisateur</label>
            <select name="organisateur" class="form-control" 
            wire:model.lazy="organisateur">
              @foreach($organisateurs as $o)
              <option value="{{ $o->id }}">{{ $o->nom }}</option>
              @endforeach
            </select>
            <div class="form-text">Qui organise ?</div>
            @error('organisateur')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
      </div>

      <!-- description -->
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" 
            wire:model="evenement.description" rows="3"
            placeholder="La description">
            </textarea>
            <div class="form-text">Ce qui sert à décrire l'évènement</div>
            @error('evenement.description')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
      </div>

      {{-- <x-choose-illustration wire:model="evenement.illustration" />

      <!-- illustration -->
      <livewire:choose-illustration 
              :illustration="$evenement->getMedia('illustration')->first()">
       --}}


      <div class="mb-3">
        <label for="illustration" class="form-label">Illustration</label>

        <div class="row">
          <div class="col-md-8">
            <h5>Modifier l'illustration</h5>
            <input type="file" class="form-control" 
            wire:model="newIllustration"
            >
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

    <script>

        document.addEventListener('riri', event => {
            console.log(@this.file);
        })
    </script>




    <button type="submit" class="btn btn-primary">Sauvegarder</button>
  </form>
</div>


@section('scripts')
@parent
    <script>
        // Initialise datepicker
        flatpickr('#dtpickerHoraire', {
            enableTime: true,
            dateFormat: 'Y-m-d H:i',
            altFormat: "Y-m-d H:i",
            altInput: true,
            inline: false,
            locale: "fr",
            time_24hr: true,
            //"minDate": "2020-7-12",
            //"maxDate": "2020-9-12",
            //defaultDate: ["2020-9-10"],
            defaultDate: @this.evenement.horaire,
            onChange: function(selectedDates, dateStr, instance) {
                //console.log('selectedDates::')
                //console.log(selectedDates) //valid
                //console.log('date: ', dateStr);
            }
        });

        // Initialise editors
        //var bodyEditor = new SimpleMDE({ element: document.getElementById("description") });

    </script>
@endsection
