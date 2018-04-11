<?php
namespace App\Repositories;


Class Paciente extends GuzzleHttpRequest
{
  public function ObtenerCoberturasPaciente($CodigoPaciente)
  {
    return $this->get("Pacientes.svc/ObtenerCoberturasPaciente", [
      'query' => [
            'CodigoPaciente' => $CodigoPaciente,
        ],
    ]);
  }
}
