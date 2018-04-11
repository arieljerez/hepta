<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Inicio;


class InicioController extends Controller
{
  protected $inicio;

  public function __construct(Inicio $inicio)
  {
      $this->inicio = $inicio;
  }

  public function index()
  {
    if (!request()->session()->has('Paciente'))
    {
      return redirect('/');
    }
    $CodigoPaciente = session('CodigoPaciente');

    $TurnosPaciente = $this->inicio->ObtenerUltimosTurnosPaciente($CodigoPaciente);

    return view('inicio',compact('TurnosPaciente'));
  }
}
