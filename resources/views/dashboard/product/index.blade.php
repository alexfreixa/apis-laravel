@extends('dashboard.layout')
@section('title', 'Product Index')
@section('content')

<div class="titol-pagina">
    <h2>Index de Productos</h2>
</div>

@if ($message = Session::get('success'))
    <div class="missatge correcte">
        <span>{{ $message }}</span>
    </div>
@endif
    
<a href="{{ route('product.create') }}">+ Create New Product</a>

            <div class="taula-productes">
                 <table>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th width="180px">Opciones</th>
                    </tr>
                    <tbody>
                        @foreach ($products as $product)
                        <tr class="t-tr">
                            <td class="t-id">{{ $product->id}}</td>
                            <td class="t-name">{{ $product->product_name }}</td>
                            <td class="t-desc">{{ $product->product_description }}</td>
                            <td class="t-price">{{ $product->product_price }}</td>
                            <td>
                                <form action="" method="POST">
                    
                                    <a href="{{ route('product.show', ['id' => $product->id]) }}">Ver</a>
                                    <a href="{{ route('product.edit', ['id' => $product->id]) }}">Editar</a>
                   
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="submit">Eliminar</button>

                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>

    {{ $products->links() }}


@endsection