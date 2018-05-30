<?php
namespace App\Repositories;


Class Registro extends GuzzleHttpRequest
{
    public function ObtenerCoberturas()
    {
      return $this->get("Turnos.svc/ObtenerCoberturas",[      'query' => [
                  '' => '',
              ],]);
    }
}
