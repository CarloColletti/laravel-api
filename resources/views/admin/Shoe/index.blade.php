@extends('layouts.app')

@section('cdn')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
@endsection

@section('title')
  Lista Scarpe
@endsection

@section('content')
  <div class="container">
    <div class="row">
      {{-- search bar  --}}
      <div class="row py-4">
        <div class="col-8">
          <form class="d-flex">
            <input class="form-control me-2" type="text" name="term" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>

        <div class="col-4">
          <div class="d-flex">
            <a href="{{ route('Admin.Shoe.create') }}" class="btn btn-outline-success ms-auto" type="submit">Nuova Scarpa</a>
          </div>
        </div>
      </div>
      {{-- include message success operation --}}
      @include('partials._message')
      {{-- table show all projects  --}}
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">
              <a href="{{ route('Admin.Shoe.index') }}?sort=id&order=@if ($sort = 'id' && $order != 'DESC') DESC @else ASC @endif">
                Id
                @if ($sort == 'id')
                  <i class="bi bi-triangle d-inline-block @if ($order == 'DESC') rotate_180 @endif"></i>
                @endif
              </a>
            </th>
            <th scope="col">
              <a href="{{ route('Admin.Shoe.index') }}?sort=name&order=@if ($sort = 'name' && $order != 'DESC') DESC @else ASC @endif">
                Nome Scarpa
                @if ($sort == 'name')
                  <i class="bi bi-triangle d-inline-block @if ($order == 'DESC') rotate_180 @endif"></i>
                @endif
              </a>
            </th>
            <th scope="col">
              <a href="{{ route('Admin.Shoe.index') }}?sort=brand&order=@if ($sort = 'brand' && $order != 'DESC') DESC @else ASC @endif">
                Brand
                @if ($sort == 'brand')
                  <i class="bi bi-triangle d-inline-block @if ($order == 'DESC') rotate_180 @endif"></i>
                @endif
              </a>
            </th>
            <th scope="col">
              <a href="{{ route('Admin.Shoe.index') }}?sort=size&order=@if ($sort = 'size' && $order != 'DESC') DESC @else ASC @endif">
                Taglia
                @if ($sort == 'size')
                  <i class="bi bi-triangle d-inline-block @if ($order == 'DESC') rotate_180 @endif"></i>
                @endif
              </a>
            </th>
            <th scope="col">
              <a href="{{ route('Admin.Shoe.index') }}?sort=price&order=@if ($sort = 'price' && $order != 'DESC') DESC @else ASC @endif">
                prezzo
                @if ($sort == 'price')
                  <i class="bi bi-triangle d-inline-block @if ($order == 'DESC') rotate_180 @endif"></i>
                @endif
              </a>
            </th>
            <th scope="col">
              <a href="{{ route('Admin.Shoe.index') }}?sort=type&order=@if ($sort = 'type' && $order != 'DESC') DESC @else ASC @endif">
                Tipo
                @if ($sort == 'type')
                  <i class="bi bi-triangle d-inline-block @if ($order == 'DESC') rotate_180 @endif"></i>
                @endif
              </a>
            </th>
            <th scope="col">
              <a href="{{ route('Admin.Shoe.index') }}?sort=updated_at&order=@if ($sort = 'type' && $order != 'DESC') DESC @else ASC @endif">
                Ultima Modifica
                @if ($sort == 'updated_at')
                  <i class="bi bi-triangle d-inline-block @if ($order == 'DESC') rotate_180 @endif"></i>
                @endif
              </a>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($shoes as $shoe)
            <tr>
              <th scope="row">{{$shoe->id}}</th>
              <td>{{$shoe->name}}</td>
              <td>{{$shoe->brand}}</td>
              <td>{{$shoe->size}}</td>
              <td>{{$shoe->price}}€</td>
              <td>{{$shoe->type}}</td>
              <td>{{$shoe->updated_at}}</td>
              {{-- button function --}}
              <td class="">
                <a href="{{ route('Admin.Shoe.show',['Shoe'=>$shoe]) }}" class="px-2">
                  <i class="bi bi-card-list"></i>
                </a>
                <a href="{{ route('Admin.Shoe.edit',['Shoe'=>$shoe]) }}" class="px-2">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <button type="button" class="btn bi bi-trash" data-bs-toggle="modal" data-bs-target="#delete-modal-{{$shoe->id}}"></button>
              </td>
            </tr>
          @endforeach
          
        </tbody>
      </table>
      {{-- end table  --}}


      {{-- paginate bootstrap --}}
      {{ $shoes->links() }}
    </div>
  </div>
@endsection

@section('modal')
    @foreach ($shoes as $shoe)
  <div class="modal fade" id="delete-modal-{{$shoe->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Conferma di Eliminazione della scarpa</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Se si procede, l'elemento: {{$shoe->name}} verrà eliminato.<br>
          L'operazione non è reversibile <br>
          Vuoi davvero procedere?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
          <form action="{{route('Admin.Shoe.destroy',['Shoe' => $shoe])}}" method="POST" class="px-2 text-danger">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Elimina</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endforeach
@endsection