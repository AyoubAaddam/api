<?php

namespace App\Http\Controllers\api;

use App\Models\productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class productocontroller extends Controller
{
    //
    function index(){
        $products = productos::all();
        if($products->isNotEmpty()){
            return response()->json(['data' => $products], 200);
        } else {
            return response()->json(['data' => 'Aun no hay datos de productos'], 404);
        }
    }

    function show($id){
        $product = productos::find($id);
        if($product){
            return response()->json(['data' => $product], 200);
        } else {
            return response()->json(['data' => 'Producto deseado no existe '], 404);
        }
    }
    function store(Request $request){
        $request->validate([
            'pord_nom' => 'required|string',
            'pord_obs' => 'required|string',
        ]);

        $productData = [
            'pord_nom' => $request->pord_nom,
            'pord_obs' => $request->pord_obs
        ];

        try {
            Productos::create($productData);
            return response()->json(['data' => 'Producto insertado correctamente'], 200);
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                return response()->json(['data' => 'Producto ya existe'], 404);
            }
            return response()->json(['data' => 'Error al insertar el producto'], 404);
        }
    }
    function update(Request $request){
        $product = productos::find($request->id);

        if($product){
            try{
                $product->update($request->all());
                return response()->json(['data' => 'Producto actualizado correctamente'], 200);
            }
            catch(\Exception $e){
                if($e->getCode() == 23000) return response()->json(['data' => 'Error al actualizar el producto, el nombre ya existe'], 404);
                return response()->json(['data' => 'Error al actualizar el producto'], 404);
            }

        }

    }

    function destroy($id){
        try{
            $deleted = productos::where('id', $id)->delete();
            productos::where('id', '>', $id)->update(['id' => DB::raw('id - 1')]);;

            if($deleted) {
                return response()->json(['data' => 'Producto eliminado con éxito'], 200);
            } else {
                return response()->json(['data' => 'Error al eliminar el producto'], 404, []);
            }
        }
        catch(\Exception $e){
            return response()->json(['data' => 'Error al eliminar el producto'], 404, [], JSON_UNESCAPED_UNICODE);
        }

    }
}
