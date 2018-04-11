<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Nuevo cliente con un url base
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect()->route('login');
})->name('root');


Route::get('login', function () {
  if (request()->session()->has('Paciente'))
  {
    return redirect('/inicio');
  }
    return view('login');
})->name('login');

Route::post('login', function (){
  $documento = request()->input('documento');
  $clave = request()->input('clave');

  $http = new Client([
      // Base URI is used with relative requests
      'base_uri' => 'http://appturnos.markey.com.ar',
      // You can set any number of default request options.
      'timeout'  => 2.0,
  ]);

  $url = "hepta/Pacientes.svc/autenticarpaciente";

  $response = $http->request('GET',$url, [
    'query' => [
          'Usuario' => $documento,
          'Clave' => $clave, // '5497032',
      ],
  ]);
  $body = json_decode($response->getBody()->getContents());

  if($body->AutenticarPacienteResult->AuthToken == ""){
      return redirect('/');
  }

  $paciente = $body->AutenticarPacienteResult->Pacientes[0];
  $CodigoPaciente = $paciente->CodigoPaciente;

  session(['CodigoPaciente' => $CodigoPaciente]);
  session(['Paciente' => $paciente]);

  return redirect()->route('inicio');

})->name('login');

Route::get('logout', function(Request $request){
  $request->session()->forget('CodigoPaciente');
  $request->session()->forget('Paciente');
  $request->session()->flush();
  $request->session()->regenerate();
  return redirect('/');
})->name('logout');


Route::get('nuevoturno/{CodigoCobertura?}/{CodigoPlan?}/{CodigoEspecialidad?}/{CodigoProfesional?}', function ($CodigoCobertura = null, $CodigoPlan= null, $CodigoEspecialidad = null, $CodigoProfesional = null) {
  if (!request()->session()->has('Paciente'))
  {
    return redirect('/');
  }

  $paciente = json_encode( session('Paciente'));
  return view('nuevoturno',compact(['paciente','CodigoCobertura','CodigoPlan','CodigoEspecialidad','CodigoProfesional']));
})->name('nuevoturno');

Route::get('inicio', 'InicioController@Index' )->name('inicio');

Route::get('recuperarclave', function () {
    return view('recuperarclave');
})->name('recuperarclave');

Route::get('confirmar_email', function () {
    return view('confirmar_email', compact(['documento','fecha_nacimiento']));
});

Route::post('confirmar_email', function (){

    $http = new Client;
    $uri_base= "http://appturnos.markey.com.ar/hepta/Pacientes.svc/";

    $documento = request()->input('documento');
    $fecha_nacimiento = request()->input('fecha_nacimiento'); //"2018-03-17"

    $d = DateTime::createFromFormat("Y-m-d", $fecha_nacimiento);
    $fecha_nacimiento_mdy = $d->format("m/d/Y"); // or any you want

    $url = $uri_base."VerificarPaciente";

    $response = $http->request('GET',$url, [
      'query' => [
            'Documento' => request()->input('documento'),
            'FechaNacimiento' => $fecha_nacimiento_mdy, // '5497032',
        ],
    ]);

    $array = (json_decode((string) $response->getBody(), true));

    if($array['VerificarPacienteResult']['AuthToken'] != ""){
        return view('confirmar_email', compact(['documento','fecha_nacimiento']));
    }
    $fecha_nacimiento = request()->input('fecha_nacimiento');
    return redirect()->route('registrarse',compact(['documento','fecha_nacimiento']));

});

Route::get('registrarse', function () {
    $documento = request()->input('documento');
    $fecha_nacimiento = request()->input('fecha_nacimiento'); //"2018-03-17"
    return view('registrarse', compact(['documento','fecha_nacimiento']));
})->name('registrarse');

Route::get('mis-datos', function () {
  if (!request()->session()->has('Paciente'))
  {
    return redirect('/');
  }

    $paciente = session('Paciente');

    $CodigoPaciente = session('CodigoPaciente');

    $http = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'http://appturnos.markey.com.ar',
        // You can set any number of default request options.
        'timeout'  => 2.0,
    ]);

    $url = "hepta/Pacientes.svc/ObtenerCoberturasPaciente";

    $response = $http->request('GET',$url, [
      'query' => [
            'CodigoPaciente' => $CodigoPaciente,
        ],
    ]);

    $body = json_decode($response->getBody()->getContents());

    $coberturas = $body->ObtenerCoberturasPacienteResult->CoberturasPaciente;

    return view('mis_datos', compact('paciente','coberturas'));
})->name('mis-datos');

Route::get('turnos','TurnoController@all')->name('turnos');
