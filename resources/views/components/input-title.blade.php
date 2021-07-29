  <div x-data="{ myslug: @entangle('slug') }">

      <!-- titre -->
      <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <div class="row">
          <div class="col-md-7">
            <input type="text" name="titre" class="form-control" 
            {{ $attributes }}
            wire:keyup="changeTitre"
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
                  x-model="myslug"
                  placeholder="Slug">
            </div>
          </div>
        </div>
      </div>

</div>
