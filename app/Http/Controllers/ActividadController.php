<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Actividad::get(); 

        return response()->json($datas, $this->successStatus); 
    }

    /**
     * Display one resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        $data = Actividad::where('id',$id)->first();

        return response()->json($data, $this->successStatus); 
    }

    /**
     * Display one resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getByUserId($id)
    {
        $data = Actividad::whereHas('usuarios',function($query) use($id){
            $query->where('id',$id);
        })->get();

        return response()->json($data, $this->successStatus); 
    }


    public function crearActividad(request $request,$proyecto_id){

        $requestData=$request->all();
        $proyecto=Proyecto::find($proyecto_id);
        if($proyecto!=NULL){
            if($proyecto->responsable()==session('usuario_id')){
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

        $actividad=Actividad::find($id);
        if($actividad==NULL){
            return response()->json(["error" => "No existe la actividad."], 404);
        }
        if($actividad->proyecto->responsable->id==session('usuario_id')){
            if (isset($requestData['participantes']) || isset($requestData['responsable'])) {
                $usuarios=[];
                if(isset($requestData['participantes'])) array_merge($usuarios,$requestData['participantes']);
                if(isset($requestData['responsable'])){
                    array_merge($usuarios,$requestData['responsable']);
                    $actividad->usuarios()->sync($usuarios);
                    foreach($actividad->usuarios as $usuario){
                        if($usuario->id==$requestData['responsable']){
                            $usuario->pivot->update(['responsable'=>1]);
                        }
                    }
                }elseif( isset($requestData['responsable']) && count($requestData['responsable'])!=1){
                    return response()->json(["error" => "Ha introducido más de un responsable"], 405);
                }
                return response()->json($actividad, $this->successStatus);
            }else{
                return response()->json(["error" => "No existen participantes o responsable"], 405);
            }
        }else{
            return response()->json(["error" => "El usuario no es responsable del proyecto"], 405);
        }

    }
}
