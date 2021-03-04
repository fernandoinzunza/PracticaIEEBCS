<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aula;
use App\Computadora;
class AulasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("aulas");
    }
    public function getAulas()
    {
        $aulas = Aula::all();
        return $aulas;
    }
    public function getComputadoras(Request $request)
    {
        $aula = Aula::find($request->id);
        return  $aula->Computadoras;
        
    }
    public function agregarComputadora(Request $request)
    {
        $computadora = Computadora::find($request->id);

        if($computadora->Aula !=null)
        {
            $computadora->aula_destinada = $request->aula_id;
            $computadora->save();
            return response()->json([
                'message' => 'PC agregado correctamente'
            ]);
        }
        else{
            return response()->json([
                'message' => $computadora->Aula
            ]);
        }
        
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->nombre == null)
       {
        return response()->json([
            'message' => 'Agrega el nombre del aula!!',
        ]);  
       }
       else{
        $aula = new Aula;
        $aula->nombre =$request->nombre;
        $aula->save();
       
        return response()->json([
            'message' => 'Aula creada correctamente'
        ]);
       }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
