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


    public function CancelarTurno($CodigoTurno,$AnoTurno)
    {
      $body = $this->get("Turnos.svc/CancelarTurno", [
        'query' => [
              'CodigoTurno' => $CodigoTurno,
              'AnoTurno' => $AnoTurno
          ],
      ]);
      return $body->CancelarTurnoResult;
    }
}
