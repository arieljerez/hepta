<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $documento = request()->input('documento');
      $fecha_nacimiento = request()->input('fecha_nacimiento'); //"2018-03-17"
      return view('registrarse', compact(['documento','fecha_nacimiento']));
  }

}
