<?php
namespace App\Repositories;


Class Turno extends GuzzleHttpRequest
{
    public function ObtenerTurnosPaciente($CodigoPaciente)
    {
      $body = $this->get("Pacientes.svc/ObtenerTurnosPaciente", [
        'query' => [
              'CodigoPaciente' => $CodigoPaciente,
          ],
      ]);
      return $body->ObtenerTurnosPacienteResult->TurnosPaciente;
    }

}
