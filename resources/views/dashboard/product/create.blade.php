@extends('dashboard.layout')
@section('title', 'Creating a Product')
@section('content')

<!-- Create Post -->

<div>
    <h1>
      Create Product
    </h1>
  </div>

  <!-- Messages -->
  {{-- @include('dashboard.fragment.errors-form') --}}
  

  <div>
    <form method="POST" action="{{ route('product.store') }}">

       @csrf
      <div>
        <label for="product_name">Nombre</label>
        <input type="text" name="product_name"/>
      </div>
      <div>
        <label for="product_description">Descripcion</label>
        <input type="text" name="product_description"/>
      </div>
      <div>
        <label for="product_price">Precio</label>
        <input type="text" name="product_price"/>
      </div>
      <div>
        <button type="submit">Crear</button>
        <a href="{{ route('product.index') }}">Cancelar</a>
      </div>
    </form>
  </div>

@endsection
