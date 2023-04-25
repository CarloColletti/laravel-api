@extends('layouts.app')

@section('title')
  Aggiungi Scarpa
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <h2>
        Inserisci i dati della nuova Scarpa
      </h2>
      {{-- form add new shoes  --}}                   {{-- serve enctype="multipart/form-data" per consentire al form di inviare dei file senza di esso nn funzionerà --}}
      <form action="{{ route('Admin.Shoe.store') }}" enctype="multipart/form-data" method="POST" class="row py-5">
        {{-- token  --}}
        @csrf

        {{-- input group  --}}
        <div class="col-5">
          <div class="container px-0">
            <div class="row">
              {{------------------ insert data  ------------------}}


              {{-- name shoe  --}}
              <div class="col-12 py-2">
                <label for="name" class="form-label">Nome della scarpa:</label>
                <div class="input-group mb-4">
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name='name' id='name' placeholder="Nome" value="{{ old('name') }}">
                  {{-- error message  --}}
                  @error('name')
                    <div class="invalid-tooltip">
                      {{$message}}
                    </div>
                  @enderror
                </div>
              </div>

              {{-- name brand  --}}
              <div class="col-12 py-2">
                <label for="brand" class="form-label">Nome del brand:</label>
                <div class="input-group mb-4">
                  <input type="text" class="form-control @error('brand') is-invalid @enderror" name='brand' id='brand' placeholder="brand" value="{{ old('brand') }}">
                  {{-- error message  --}}
                  @error('brand')
                    <div class="invalid-tooltip">
                      {{$message}}
                    </div>
                  @enderror
                </div>
              </div>

              {{-- size shoe  --}}
              <div class="col-12 py-2">
                <label for="size" class="form-label">Misura</label>
                <div class="input-group mb-4">
                  <input type="number" class="form-control @error('size') is-invalid @enderror" name='size' id='size' value="{{ old('size') }}">
                  {{-- error message  --}}
                  @error('size')
                    <div class="invalid-tooltip">
                      {{$message}}
                    </div>
                  @enderror
                </div>
              </div>

              {{-- price shoe  --}}
              <div class="col-12 py-2">
                <label for="price" class="form-label">Prezzo</label>
                <div class="input-group mb-4">
                  <input type="number" class="form-control @error('price') is-invalid @enderror" name='price' id='price' value="{{ old('price') }}">
                  {{-- error message  --}}
                  @error('price')
                    <div class="invalid-tooltip">
                      {{$message}}
                    </div>
                  @enderror
                </div>
              </div>

              {{-- type of shoes --}}
              <div class="col-12 py-2">
                <label for="type" class="form-label">Tipo di Scarpa:</label>
                <div class="mb-3">
                  <select class="form-select form-control" name='type' id='type'>
                    <option value="elegant">Elegante</option>
                    <option value="sportive">Sportivo</option>
                    <option value="casual">Casual</option>
                  </select>
                </div>
              </div>

              {{-- save storege image  --}}
              
              <label for="img" class="form-label">Carica un'immagine</label>
              <div class="input-group mb-3">
                <input type="file" class="form-control @error('img') is-invalid @enderror" id="img" name='img'>
              </div>

              {{-- -------------------------------- --}}

            </div>
          </div>
        </div>

        {{-- image preview (placeholder)  --}}
        <div class="col-6">
          {{-- da inserire quando si aggiungeranno fisicamente le immagini  --}}
        </div>

        {{-- save data  --}}
        <div class="col-2">
          <button type="submit" class="btn btn-outline-success">Salva</button>
        </div>
      </form>

      {{-- botton return to shoe list  --}}
      <div class="row py-5">
        <div class="col-2 ms-auto">
          <a href="{{ route('Admin.Shoe.index') }}" class="btn btn-outline-success">Torna alla lista</a>
        </div>
      </div>

    </div>
  </div>
@endsection