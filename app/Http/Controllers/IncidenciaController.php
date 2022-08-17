<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Incidencia;
use Illuminate\Http\Request;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Incidencia::get(); 

        return response()->json($datas, $this->successStatus); 
    }

    /**
     * Display one resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        $data = Incidencia::where('id',$id)->first();

        return response()->json($data, $this->successStatus); 
    }

    /**
     * Display one resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getByResponsableId($id)
    {
        $data = Incidencia::whereHas('actividad',function($query) use($id){
            $query->whereHas('usuarios',function($query2) use($id){
                $query2->where('id',$id)->wherePivot('responsable',1);
            });
        })->get();

        return response()->json($data, $this->successStatus); 
    }


    public function crearActividad(request $request,$actividad_id){

        $requestData=$request->all();
        $actividad=Actividad::find($actividad_id);
        if($actividad!=NULL){
            if($actividad->responsable->id==session('usuario_id')){
                if (isset($requestData['nombre'])) {
                    $actividad=Actividad::create($requestData);
                    return response()->json($actividad, $this->successStatus);
                }else{
                    return response()->json(["error" => "No ha sido posible crear la actividad"], 405);
                }
            }else{
                return response()->json(["error" => "El usuario no es responsable del proyecto"], 405);
            }
        }else{
            return response()->json(["error" => "No existe este proyecto"], 405);
        }

    }

    public function asignarUsuarios(request $request, $id){

        $requestData=$request->all();

        $incidencia=Incidencia::find($id);
        if($incidencia==NULL){
            return response()->json(["error" => "No existe la incidencia."], 404);
        }
        if($incidencia->actividad->responsable->id==session('usuario_id')){
            if (isset($requestData['participantes']) || isset($requestData['responsable'])) {
                $usuarios=[];
                if(isset($requestData['participantes'])) array_merge($usuarios,$requestData['participantes']);
                if(isset($requestData['responsable'])){
                    array_merge($usuarios,$requestData['responsable']);
                    $incidencia->usuarios()->sync($usuarios);
                    foreach($incidencia->usuarios as $usuario){
                        if($usuario->id==$requestData['responsable']){
                            $usuario->pivot->update(['responsable'=>1]);
                        }
                    }
                }elseif( isset($requestData['responsable']) && count($requestData['responsable'])!=1){
                    return response()->json(["error" => "Ha introducido más de un responsable"], 405);
                }
                return response()->json($incidencia, $this->successStatus);
            }else{
                return response()->json(["error" => "No existen participantes o responsable"], 405);
            }
        }else{
            return response()->json(["error" => "El usuario no es responsable del proyecto"], 405);
        }

    }
}
