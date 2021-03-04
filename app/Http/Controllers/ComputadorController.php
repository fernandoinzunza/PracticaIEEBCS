<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Computadora;
use App\Alumno;
use App\Aula;

class ComputadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("nuevocomputador");
    }
    public function getComputadoresDisp()
    {
        $computadores = Computadora::Where('alumno_asignado', "=", "Ninguno")->get();
        return $computadores;
    }
    public function getComputadores()
    {
        $computadores = Computadora::all();
        return $computadores;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if ($request->nombre == null) {
            return response()->json([
                'message' => 'Agrega el nombre del PC!!',
            ]);
        } else {
            $computador = new Computadora;
            $computador->nombre = $request->nombre;
            $computador->alumno_asignado = "Ninguno";
            $computador->aula_destinada = "Ninguna";
            $computador->save();
            $computadores = Computadora::all();
            return response()->json([
                'message' => 'Computador registrado!',
                'lista' => $computadores
            ]);
        }
    }
    public function generarReporte()
    {
        $alumnos = Alumno::all();
        $html = "";
        $html.="<html>";
        $html.="<head>";
        $html.='<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
        $html.="<head>";
        $html.="<head>";
        $html.="</head>";
        $html.="<h6>Relacion de equipos de computo asignados a alumnos y aulas</h4>";
        $html .= "<table class='table table-striped'>";
        $html .= "<thead class='thead-dark'>";
        $html .= "<tr>";
        $html .= "<th scope='col'>Numero de alumno</th>";
        $html .= "<th scope='col'>Nombre</th>";
        $html .= "<th scope='col'>Computadora asignada</th>";
        $html .= "<th scope='col'>Aula</th>";
        $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody>";

        foreach ($alumnos as  $alumno) {
            $computadorasAsignadas = $alumno->ComputadorasAsignadas;
            foreach ($computadorasAsignadas as $ca) {
                if ($ca->alumno_asignado != "Ninguno" && $ca->aula_destinada != "Ninguna") {
                    $aulaDeComputadora = Aula::where("id", (int)$ca->aula_destinada)->get();
                    $html .= "<tr>";
                    $html .= "<td>" . $alumno->id;
                    $html .= "</td>";
                    $html .= "<td>" . $alumno->nombre;
                    $html .= "</td>";
                    $html .= "<td>" . $ca->nombre;
                    $html .= "</td>";
                    $html .= "<td>" . $aulaDeComputadora[0]->nombre;
                    $html .= "</td>";
                    $html .= "</tr>";
                }
            }
        }
        $html .= "</tbody>";
        $html .= "</table>";
        $html.="</html>";
        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($html);
        return $pdf->download('mi-archivo.pdf');
    }
    public function asignar(Request $request)
    {
        $computador = Computadora::find($request->id);
        $computador->alumno_asignado = $request->alumno_id;

        $computador->save();
        return response()->json([
            'message' => 'Computador asignado al alumno '
        ]);
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
