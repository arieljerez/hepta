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

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('nuevoturno', function () {

  //if (session('documento') == ""){
  //  return redirect()->route('login');
  //}
    $documento = session('documento');
    $clave = session('clave');;

    return view('nuevoturno',compact(['documento','clave']));
});

Route::get('inicio', function () {

  $documento = request()->input('documento');
  $clave = request()->input('clave');

  session(['documento' => request()->input('documento')]);
  session(['clave'=> request()->input('clave')]);

  $http = new Client;
  $uri_base= "http://appturnos.markey.com.ar/hepta/Pacientes.svc/";

  $url = $uri_base."autenticarpaciente";

  $response = $http->request('GET',$url, [
    'query' => [
          'Usuario' => $documento,
          'Clave' => $clave, // '5497032',
      ],
  ]);

  $array = (json_decode((string) $response->getBody(), true));

  if($array['AutenticarPacienteResult']['AuthToken'] != ""){
      $CodigoPaciente = $array['AutenticarPacienteResult']['Pacientes'][0]['CodigoPaciente'];
      return view('inicio',compact('CodigoPaciente'));
  }
  return redirect(route('login'));

})->name('inicio');

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
    $fecha_nacimiento = $d->format("m/d/Y"); // or any you want

    $url = $uri_base."VerificarPaciente?Documento=$documento&FechaNacimiento=$fecha_nacimiento";

    $response = $http->request('GET',$url, [
      'query' => [
            'Documento' => request()->input('documento'),
            'FechaNacimiento' => $fecha_nacimiento, // '5497032',
        ],
    ]);

    $array = (json_decode((string) $response->getBody(), true));

    if($array['VerificarPacienteResult']['AuthToken'] != ""){
        return view('confirmar_email', compact(['documento','fecha_nacimiento'=> $fecha_nacimiento_redirect]));
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
    return view('mis_datos');
})->name('mis-datos');

Route::get('turnos', function () {
    $uri_base= "http://appturnos.markey.com.ar/hepta/";
    $url = "Pacientes.svc/ObtenerTurnosPaciente";

    $http = new Client($uri_base);

    $response = $http->request('GET',$url, [
      'query' => [
            'CodigoPaciente' => 188780,
        ],
    ]);

    return view('turnos');
})->name('turnos');
