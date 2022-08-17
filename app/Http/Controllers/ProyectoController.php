<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Proyecto::get(); 

        return response()->json($datas, $this->successStatus); 
    }

    /**
     * Display one resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        $data = Proyecto::where('id',$id)->first();

        return response()->json($data, $this->successStatus); 
    }


    public function crearProyecto(request $request){

        $requestData=$request->all();
        
        if (isset($requestData['nombre'])) {
            $proyecto=Proyecto::create($requestData);
            return response()->json($proyecto, $this->successStatus);
        }else{
            return response()->json(["error" => "No ha sido posible crear el proyecto"], 405);
        }

    }

    public function asignarUsuarios(request $request, $id){

        $requestData=$request->all();

        $proyecto=Proyecto::find($id);
        if($proyecto==NULL){
            return response()->json(["error" => "No existe el proyecto."], 404);
        }

        if (isset($requestData['participantes']) || isset($requestData['responsable'])) {

            if(isset($requestData['participantes'])) $proyecto->participantes()->sync($requestData['participantes']);
            if(isset($requestData['responsable']) && count($requestData['responsable'])==1){
                $proyecto->responsable()->sync($requestData['responsable']);
            }elseif( isset($requestData['responsable']) && count($requestData['responsable'])!=1){
                return response()->json(["error" => "Ha introducido más de un responsable"], 405);
            }
            return response()->json($proyecto, $this->successStatus);
        }else{
            return response()->json(["error" => "No existen participantes o responsable"], 405);
        }

    }
}
