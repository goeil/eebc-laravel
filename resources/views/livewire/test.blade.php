<div>
  <form wire:submit.prevent="submit">
      <!-- titre -->
      <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <div class="row">
          <div class="col-md-7">
            <input type="text" name="titre" class="form-control" 
            wire:model="evenement.titre"
            wire:keyup="slug"
            placeholder="Titre">
            <div class="form-text">Votre titre</div>
            @error('evenement.titre')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-5">
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing-sm">Slug</span>
              <input type="text" name="slug" class="form-control" 
                wire:model="slug"
                placeholder="Slug">
            </div>
          </div>
        </div>
      </div>

      <!-- horaire -->
      <div class="mb-3" wire:ignore>
        <label for="horaire" class="form-label">Horaire</label>
            <input type="text" name="horaire" class="form-control" 
            wire:model.lazy="horaire"
            id="dtpickerHoraire"
            placeholder="Date et heure">
            <div class="form-text">Date et heure de l'évènement</div>
            @error('horaire')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
      </div>

      <!-- type -->
      <div class="mb-3">
        <label for="type" class="form-label">Type</label>
            <select name="type" class="form-control" 
            wire:model="type">
              @foreach(\App\Models\TypeEvenement::all() as $t)
              <option value="{!! $t->id !!}" wire:key="{{ $t->id }}"
              >{{ $t->nom }}</option>
              @endforeach
            </select>
            <div class="form-text">Ce qui sert à décrire l'évènement</div>
            @error('type')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
      </div>

    <button type="submit" class="btn btn-primary">Sauvegarder</button>
  </form>
</div>


@section('scripts')
    <script>

        document.addEventListener('livewire:load', event => {
        console.log(@this.horaire);
            flatpickr('#dtpickerHoraire', {
                enableTime: true,
                //dateFormat: 'Y-m-d H:i',
                dateFormat: 'Y-m-d H:i',
                //altFormat: "j F Y, H:i",
                altFormat: "Y-m-d H:i",
                altInput: true,
                inline: false,
                locale: "fr",
                time_24hr: true,
                //"minDate": "2020-7-12",
                //"maxDate": "2020-9-12",
                //defaultDate: ["2020-9-10"],
                //defaultDate: @this.horaire,
                onChange: function(selectedDates, dateStr, instance) {
                    console.log('selectedDates::')
                    console.log(selectedDates) //valid
                    
                    console.log('date: ', dateStr);
                }
            });
        })
    </script>
@endsection
