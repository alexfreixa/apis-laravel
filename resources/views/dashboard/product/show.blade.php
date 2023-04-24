@extends('dashboard.layout')
@section('title', 'Editing Product')
@section('content')

<div class="titol-pagina">
    <h2>Producto #{{ $product->id }}</h2>
</div>

<div class="taula-productes">
    <table>
       <tr>
           <th>ID</th>
           <th>Nombre</th>
           <th>Descripcion</th>
           <th>Precio</th>
       </tr>
       <tbody>
        <tr class="t-tr">
            <td class="t-id">{{ $product->id}}</td>
            <td class="t-name">{{ $product->product_name }}</td>
            <td class="t-desc">{{ $product->product_description }}</td>
            <td class="t-price">{{ $product->product_price }}</td>
        </tr>
       </tbody>
    </table>


@endsection