<?php

namespace App\Http\Controllers\Api;

use App\Models\categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class categoriacontroller extends Controller
{
    function index(){
        $posts=categoria::all();
        if($posts){
           return response()->json(['data'=>$posts],200);
        }else{
            return response()->json(['data'=>'No posts'],404);
        }

    }

    //GET /id
    function show($id){
        $categoria = categoria::find($id);

        if(is_null($categoria)){

            return response()->json('Registro no encontrado', 404);
          }else{
            return response()->json(['data'=>$categoria],200);
          }


    }

    //post
    function store(Request $request){

        $request->validate([
            'cat_nom' => 'required|string',
            'cat_obs' => 'required|string',
        ]);

        $categoriaData = [
            'cat_nom' => $request->cat_nom,
            'cat_obs' => $request->cat_obs
        ];

        try {
            categoria::create($categoriaData);
            return response()->json(['data' => 'Producto insertado correctamente'], 200);
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                return response()->json(['data' => 'Producto ya existe'], 404);
            }
            return response()->json(['data' => 'Error al insertar el producto'], 404);
        }

    }


    function update(Request $request,$id){
        $categoria = categoria::find($id);


         if($categoria){
            try{
                $categoria->update($request->all());
                return response()->json(['data' => 'categoria actualizado correctamente'], 200);
            }
            catch(\Exception $e){
                if($e->getCode() == 23000) return response()->json(['data' => 'Error al actualizar el categoria, el nombre ya existe'], 404);
                return response()->json(['data' => 'Error al actualizar el categoria'], 404);
            }

        }
    }

    function destroy($id){
      /*  $categoria = categoria::find($id);

        if(is_null($categoria)){

            return response()->json('Registro no enc ontrado', 404);
          }
          $categoria->delete();
          return  response()->json('Registro ELIMINADO correctamente', 200);*-*/
          try{
            $deleted = categoria::where('id', $id)->delete();
            categoria::where('id', '>', $id)->update(['id' => DB::raw('id - 1')]);;

            if($deleted) {
                return response()->json(['data' => 'Categoria eliminado con éxito'], 200);
            } else {
                return response()->json(['data' => 'Error al eliminar el Categoria'], 404);
            }
        }
        catch(\Exception $e){
            return response()->json(['data' => 'Error al eliminar el Categoria'], 404);
        }

    }





}
