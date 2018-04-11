<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Paciente;

class PacienteController extends Controller
{

  protected $paciente;

  public function __construct(Paciente $paciente)
  {
      $this->paciente = $paciente;
  }

    public function MisDatos()
    {

      if (!request()->session()->has('Paciente'))
      {
        return redirect('/');
      }

        $paciente = session('Paciente');

        $CodigoPaciente = session('CodigoPaciente');


        $body = $this->paciente->ObtenerCoberturasPaciente($CodigoPaciente);

        $coberturas = $body->ObtenerCoberturasPacienteResult->CoberturasPaciente;

        return view('mis_datos', compact('paciente','coberturas'));
    }
}
