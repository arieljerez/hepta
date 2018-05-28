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

    $respuesta = $this->acceso->VerificarPaciente($documento,$this->ConvertirFechaMDY($fecha_nacimiento));

    if($respuesta->VerificarPacienteResult->AuthToken != ""){
        $paciente = $respuesta->VerificarPacienteResult->Pacientes[0];
        //dd($paciente);
        session(['paciente'=> $paciente]);
        return redirect('confirmar_email');
    }

    return redirect()->action('RegistroController@index',compact(['documento','fecha_nacimiento']));
  }

  public function GenerarClavePaciente(Request $request)
  {
    $CodigoPaciente = $request->input('CodigoPaciente');
    $Mail = $request->input('email');

    $validatedData = $request->validate([
        'email' => 'required|email|confirmed',
        'CodigoPaciente' => 'required',
    ]);

    $respuesta = $this->acceso->GenerarClavePaciente($CodigoPaciente,$Mail);

    if($respuesta->GenerarClavePacienteResult->Mensaje == "OK"){
        return redirect('login')->with(
          [
            'status' => 'Se ha enviado la contraseña a la dirección de correo',

          ]);
    }
    return redirect()->back()->withInput()->with('error', $respuesta->GenerarClavePacienteResult->Mensaje );
  }

  public function ConfirmarEmail()
  {
    return view('confirmar_email',['paciente' => session('paciente')]);
  }

  public function ConvertirFechaMDY($fecha)
  {
    $d = \DateTime::createFromFormat("Y-m-d", $fecha);
    return  $d->format("m/d/Y"); // or any you want
  }


  public function RecuperarClave()
  {
      return view('recuperarclave');
  }

  // LOGIN
  //
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

}
