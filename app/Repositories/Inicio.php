<?php
namespace App\Repositories;


Class Inicio extends GuzzleHttpRequest
{
    public function ObtenerUltimosTurnosPaciente($CodigoPaciente)
    {
      $body = $this->get("Pacientes.svc/ObtenerUltimosTurnosPaciente", [
        'query' => [
              'CodigoPaciente' => $CodigoPaciente,
          ],
      ]);
      return $body->ObtenerUltimosTurnosPacienteResult->TurnosPaciente;
    }

}
