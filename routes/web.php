<?php

// Nuevo cliente con un url base
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect()->route('login');
})->name('root');

Route::get('inicio', 'InicioController@Index' )->name('inicio');

Route::get('login', 'AccesoController@GetLogin')->name('login');
Route::post('login', 'AccesoController@PostLogin')->name('login');
Route::get('logout', 'AccesoController@LogOut')->name('logout');
Route::post('confirmar_email', 'AccesoController@VerificarPaciente');
Route::get('recuperarclave','AccesoController@RecuperarClave')->name('recuperarclave');
Route::get('registrarse','AccesoController@Registrarse')->name('registrarse');

Route::get('nuevoturno/{CodigoCobertura?}/{CodigoPlan?}/{CodigoEspecialidad?}/{CodigoProfesional?}', function ($CodigoCobertura = null, $CodigoPlan= null, $CodigoEspecialidad = null, $CodigoProfesional = null) {
  if (!request()->session()->has('Paciente'))
  {
    return redirect('/');
  }

  $paciente = json_encode( session('Paciente'));
  return view('nuevoturno',compact(['paciente','CodigoCobertura','CodigoPlan','CodigoEspecialidad','CodigoProfesional']));
})->name('nuevoturno');



Route::get('mis-datos', 'PacienteController@MisDatos')->name('mis-datos');

Route::get('turnos','TurnoController@all')->name('turnos');
