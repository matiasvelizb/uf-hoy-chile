<?php

/**
 * @author Matías Véliz
 *
 * @return float UF del día de hoy
 */
function UFHoy()
{
  $anio = date("Y");

  $contenido = file_get_contents("http://www.sii.cl/valores_y_fechas/uf/uf" . $anio . ".htm");
  $dom = new DOMDocument;
  $dom->loadHTML($contenido);
  $tabla = $dom->getElementById('table_export'); // Boton compartir

  // Valores de todo el anio
  foreach ($tabla->getElementsByTagName("tr") as $meses => $tr) {
    foreach ($tr->getElementsByTagName('td') as $dias => $td) {
      $valores_mensuales[$dias][$meses] = $td->nodeValue;
    }
  }

  // Formato
  $mes = date('n') - 1;
  $uf = $valores_mensuales[$mes][date("j")];
  $uf = str_replace(".", "", $uf);
  $uf = str_replace(",", ".", $uf);
  // echo date("j-n-Y") . "<br>";
  return (float) $uf;
}
