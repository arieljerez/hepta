<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Acceso;

class AccesoController extends Controller
{
  protected $acceso;

  public function __construct(Acceso $acceso)
  {
      $this->acceso = $acceso;
  }
  public function VerificarPaciente(Request $request)
  {
    $documento = $request->input('documento');
    $fecha_nacimiento = $request->input('fecha_nacimiento'); //"2018-03-17"

    $d = \DateTime::createFromFormat("Y-m-d", $fecha_nacimiento);
    $fecha_nacimiento_mdy = $d->format("m/d/Y"); // or any you want

    $body = $this->acceso->VerificarPaciente($documento,$fecha_nacimiento_mdy);

    if($body->VerificarPacienteResult->AuthToken != ""){
        return view('confirmar_email', compact(['documento','fecha_nacimiento']));
    }

    $fecha_nacimiento = $request->input('fecha_nacimiento');
    return redirect()->route('registrarse',compact(['documento','fecha_nacimiento']));

  }

  public function PostLogin(Request $request)
  {
    $documento = $request->input('documento');
    $clave = $request->input('clave');

    $body = $this->acceso->AutenticarPaciente($documento,$clave);

    if($body->AutenticarPacienteResult->AuthToken == ""){
        return redirect('/');
    }

    $paciente = $body->AutenticarPacienteResult->Pacientes[0];
    $CodigoPaciente = $paciente->CodigoPaciente;

    session(['CodigoPaciente' => $CodigoPaciente]);
    session(['Paciente' => $paciente]);

    return redirect()->route('inicio');
  }

  public function GetLogin()
  {
    if (request()->session()->has('Paciente'))
    {
      return redirect('/inicio');
    }
      return view('login');
  }

  public function LogOut(Request $request)
  {
    $request->session()->forget('CodigoPaciente');
    $request->session()->forget('Paciente');
    $request->session()->flush();
    $request->session()->regenerate();
    return redirect('/');
  }

  public function RecuperarClave()
  {
      return view('recuperarclave');
  }

  public function Registrarse()
  {
    $documento = request()->input('documento');
    $fecha_nacimiento = request()->input('fecha_nacimiento'); //"2018-03-17"
    return view('registrarse', compact(['documento','fecha_nacimiento']));
  }
}
