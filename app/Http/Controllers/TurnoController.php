<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Repositories\Turno;

class TurnoController extends Controller
{
    protected $turno;

    public function __construct(Turno $turno)
    {
        $this->turno = $turno;
    }

    function destroy(Request $request)
    {

    }

    function all()
    {
      $turnos = $this->turno->ObtenerTurnosPaciente( session('CodigoPaciente') );
      return view('turnos',compact('turnos'));
    }

    static function ObtenerObjectoFecha($jsonDate){
      // Let's assume you did JSON parsing and got your date string
      $date = $jsonDate ;
      // Parse the date to get timestamp and timezone if applicable
      preg_match('/\/Date\(([0-9]+)(\-[0-9]+)?/', $date, $time);

      // remove milliseconds from timestamp
      $ts = $time[1] / 1000;

      // Define Time Zone if exists
      $tz = isset($time[2]) ? new \DateTimeZone($time[2]) : null;

      // Create a new date object from your timestamp
      // note @ before timestamp
      // and don't specify timezone here as it will be ignored anyway
      $dt = new \DateTime();
      $dt->setTimestamp($ts);

      // If you'd like to apply timezone for whatever reason
      if ($tz) {
        $dt->setTimezone($tz);
      }

      return $dt;
    }
}
