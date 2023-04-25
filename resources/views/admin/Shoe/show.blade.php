@extends('layouts.app')

@section('title')
  Dettaglio Scarpa
@endsection

@section('content')
  <div class="container">
    
    <div class="row py-4">
      <h2>
        Stai visualizzando la Scarpa: {{$Shoe->name}}
      </h2>
    </div>
    {{-- include message success operation --}}
    @include('partials._message')
    {{-- button to modify shoe  --}}
    <div class="row py-5">
      <div class="col-2 ms-auto">
        <a href="{{ route('Admin.Shoe.edit', ['Shoe'=>$Shoe]) }}" class="btn btn-outline-success ms-auto" type="submit">Modifica</a>
      </div>
    </div>
    {{-- detail shoe  --}}
    <div class="row">
      {{-- list detail  --}}
      <div class="col-7">
        <ul>
          <li>Nome: {{$Shoe->name}}</li>
          <li>Brand: {{$Shoe->brand}}</li>
          <li>Taglia: {{$Shoe->size}}</li>
          <li>Prezzo: {{$Shoe->price}}€</li>
          <li>Tipologia: {{$Shoe->type}}</li>
        </ul>
      </div>

      {{-- image shoe  --}}
      <div class="col-5">
        <img src="{{ $Shoe->getImage() }}" alt="{{ $Shoe->name }}-image" class="img-fluid">
      </div>
    </div>

    {{-- botton return to shoe list  --}}
    <div class="row py-5">
      <div class="col-2 ms-auto">
        <a href="{{ route('Admin.Shoe.index') }}" class="btn btn-outline-success">Torna alla lista</a>
      </div>
    </div>
    
  </div>
@endsection