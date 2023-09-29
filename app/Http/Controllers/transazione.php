<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\tarea;
use App\Models\categoria;
use App\Models\revision;
use Illuminate\Support\Facades\DB;

class transazione extends Controller
{
    
    public function addWithCat(Request $request){

        $tarea = new tarea();
        $categoria = new categoria();

        try{
            DB::RAW('LOCK TABLES tarea READ, tarea_categoria READ');
            $tarea->titulo = $request->titulo;
            $tarea->contenido = $request->contenido;
            $tarea->estado = $request->estado;
            $tarea->usuario_id = $request->usuario_id;
            $tarea->save();

            $categoria->tarea_id = $tarea->id;
            $categoria->save();
         
            DB::commit();
            DB::RAW('UNLOCK TABLES');

        }
        
        catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'error' => 'Error al crear la tarea con 2 categorias'
            ], 500);
        }
    }

    public function tarea( Request $request){

        $tarea = new tarea();
        $revision = new revision();

        try{

            DB::RAW('LOCK TABLES tarea WRITE, revision WRITE, tarea READ, revision READ');

            $tarea->titulo = $request->titulo;
            $tarea->contenido = $request->contenido;
            $tarea->estado = $request->estado;
            $tarea->usuario_id = $request->usuario_id;
            $tarea->save();

            $revision->detalle = $request->detalle;
            $revision->tarea_id = $tarea->id;
            $revision->save();

            DB::commit();
            DB::RAW('UNLOCK TABLES');S
        }

        catch{
            DB::rollback();
            return response()->json([
                'error' => 'Error al crear la tarea con revision'
            ], 500);}


    }

}
