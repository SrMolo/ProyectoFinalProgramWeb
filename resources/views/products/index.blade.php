@extends('layouts.app')

@section('title', 'Lista de Productos')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-gray-800">Productos</h2>
    <a href="{{ route('products.create') }}"
      class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
      Nuevo Producto
    </a>
  </div>

  @if($products->count() > 0)
  <div class="overflow-x-auto">
    <table class="w-full">
      <thead>
        <tr class="bg-gray-200 text-gray-700">
          <th class="px-4 py-3 text-left">ID</th>
          <th class="px-4 py-3 text-left">Nombre</th>
          <th class="px-4 py-3 text-left">Precio</th>
          <th class="px-4 py-3 text-left">Stock</th>
          <th class="px-4 py-3 text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
        <tr class="border-b hover:bg-gray-50">
          <td class="px-4 py-3">{{ $product->id }}</td>
          <td class="px-4 py-3 font-semibold">{{ $product->name }}</td>
          <td class="px-4 py-3">${{ number_format($product->price, 2) }}</td>
          <td class="px-4 py-3">{{ $product->stock }}</td>
          <td class="px-4 py-3">
            <div class="flex justify-center gap-2">
              <a href="{{ route('products.show', $product) }}"
                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                Ver
              </a>
              <a href="{{ route('products.edit', $product) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                Editar
              </a>
              <form action="{{ route('products.destroy', $product) }}"
                method="POST"
                onsubmit="return confirm('¿Estás seguro?')"
                class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                  Eliminar
                </button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $products->links() }}
  </div>
  @else
  <p class="text-gray-500 text-center py-8">No hay productos registrados</p>
  @endif
</div>
@endsection