<?php
namespace App\Repositories;


Class Acceso extends GuzzleHttpRequest
{
  public function VerificarPaciente($documento, $fecha_nacimiento)
  {
    return $this->get("Pacientes.svc/VerificarPaciente", [
      'query' => [
            'Documento' => $documento,
            'FechaNacimiento' => $fecha_nacimiento, // '5497032',
        ],
    ]);
  }
  public function AutenticarPaciente($documento,$clave)
  {
    return $this->get("Pacientes.svc/autenticarpaciente", [
      'query' => [
            'Usuario' => $documento,
            'Clave' => $clave, // '5497032',
        ],
    ]);
  }
}
