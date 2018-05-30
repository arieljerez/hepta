<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Registro;

class RegistroController extends Controller
{

  protected $registro;

  public function __construct(Registro $registro)
  {
      $this->registro = $registro;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $documento = request()->input('documento');
      $fecha_nacimiento = request()->input('fecha_nacimiento'); //"2018-03-17"
      $coberturas = $this->ObtenerCoberturas();
      return view('registrarse', compact(['documento','fecha_nacimiento','coberturas']));
  }

  public function ObtenerCoberturas()
  {
    $resultado = $this->registro->ObtenerCoberturas();
    return $resultado->ObtenerCoberturasResult->Coberturas;
  }

  public function store(Request $request)
  {
    //dd($request);ç
    return redirect('/login')->with('status','Registro grabado con éxito');

  }
}
