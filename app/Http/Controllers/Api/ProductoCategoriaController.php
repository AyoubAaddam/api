<?php

namespace App\Http\Controllers\api;

use App\Models\ProductoCategoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductoCategoriaController extends Controller
{
    public function index()
    {
        $productoCategorias = ProductoCategoria::all();

        if ($productoCategorias->isNotEmpty()) {
            return response()->json(['data' => $productoCategorias], 200);
        } else {
            return response()->json(['data' => 'No existen categorías de productos'], 404);
        }
    }

    public function show($id)
    {
        $productoCategoria = ProductoCategoria::find($id);

        if ($productoCategoria) {
            return response()->json(['data' => $productoCategoria], 200);
        } else {
            return response()->json(['data' => 'La categoría de producto no existe'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|integer',
            'categoria_id' => 'required|integer',
            'producto_price' => 'required|numeric',
            'producto_stock' => 'required|integer',
        ]);

        try {
            ProductoCategoria::create($request->all());
            return response()->json(['data' => 'Categoría de producto insertada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => 'Error al insertar la categoría de producto'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'producto_id' => 'required|integer',
            'categoria_id' => 'required|integer',
            'producto_price' => 'required|numeric',
            'producto_stock' => 'required|integer',
        ]);

        $productoCategoria = ProductoCategoria::find($id);

        if ($productoCategoria) {
            try {
                $productoCategoria->update($request->all());
                return response()->json(['data' => 'Categoría de producto actualizada correctamente'], 200);
            } catch (\Exception $e) {
                return response()->json(['data' => 'Error al actualizar la categoría de producto'], 404);
            }
        } else {
            return response()->json(['data' => 'La categoría de producto no existe'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            ProductoCategoria::destroy($id);
            return response()->json(['data' => 'Categoría de producto eliminada con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => 'Error al eliminar la categoría de producto'], 404);
        }
    }
}
