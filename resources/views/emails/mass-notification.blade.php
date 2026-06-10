@php
    use Carbon\Carbon;

    $equipoUno = $partido->equipos->equipoUno ?? null;
    $equipoDos = $partido->equipos->equipoDos ?? null;

    $nombreUno = $equipoUno->nombre ?? 'Equipo 1';
    $nombreDos = $equipoDos->nombre ?? 'Equipo 2';

    $fecha = $partido->fecha_partido instanceof Carbon
        ? $partido->fecha_partido
        : Carbon::parse($partido->fecha_partido);

    $fecha->locale('es');
    $fecha->timezone('America/Guatemala');
    $fechaPartido = $fecha->isoFormat('dddd D [de] MMMM [de] YYYY · HH:mm');
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recordatorio Quiniela Medpharma</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, Helvetica, sans-serif; color:#FFFFFF; background:#F4F4F4;">

  <table width="100%" cellpadding="0" cellspacing="0" style="padding:30px 0; background:#F4F4F4;">
    <tr>
      <td align="center">

        <table width="600" cellpadding="0" cellspacing="0" style="width:600px; max-width:600px; background:#FFFFFF; border-radius:10px; overflow:hidden;">

          <tr>
            <td align="center" style="padding:30px 20px 20px 20px; border-bottom: 3px solid #01665e;">
              <img src="{{ asset('images/logos/logo-quiniela.png') }}" alt="Quiniela Medpharma" width="200" style="display:block; max-width:200px; height:auto; border:0; outline:none; text-decoration:none;">
            </td>
          </tr>

          <tr>
            <td style="padding:25px 30px 10px 30px; color:#101820; font-size:15px; line-height:1.6;">
              Estimado Dr./Dra.
            </td>
          </tr>

          <tr>
            <td style="padding:0 30px 15px 30px; color:#101820; font-size:15px; line-height:1.6;">
              Queremos expresar nuestro más sincero agradecimiento por haberse inscrito y formar parte de nuestra Quiniela. Nos entusiasma mucho contar con su participación en esta dinámica.
            </td>
          </tr>

          <tr>
            <td style="padding:0 30px 15px 30px; color:#101820; font-size:15px; line-height:1.6;">
              Le escribimos este breve recordatorio porque <strong>mañana oficialmente inicia el Mundial</strong>. Para que no se quede atrás en la tabla de posiciones, le invitamos a ingresar a la plataforma y colocar sus vaticinios para los primeros partidos.
            </td>
          </tr>

          <tr>
            <td style="padding:15px 30px 15px 30px; color:#101820; font-size:15px; line-height:1.6;">
              Recuerde un dato muy importante: tiene la flexibilidad de registrar o modificar sus pronósticos <strong>hasta una hora antes de que inicie cada encuentro</strong>. Una vez cumplido ese tiempo, el sistema se bloqueará para ese partido en específico.
            </td>
          </tr>

          <tr>
            <td style="padding:0 30px 20px 30px; color:#101820; font-size:15px; line-height:1.6;">
              Le deseamos el mayor de los éxitos con sus predicciones y esperamos que disfrute al máximo de este gran torneo futbolístico.
            </td>
          </tr>

          <tr>
            <td style="padding:10px 30px 10px 30px;">
              <table width="100%" cellpadding="0" cellspacing="0" style="background:#01665e; border-radius:8px; color:#FFFFFF;">
                <tr>
                  <td align="center" style="padding:20px 15px 8px 15px; font-size:12px; letter-spacing:1px; text-transform:uppercase; color:#FFDD00;">
                    Primer partido
                  </td>
                </tr>
                <tr>
                  <td align="center" style="padding:0 15px 10px 15px; font-size:18px; font-weight:bold;">
                    {{ $nombreUno }} <span style="color:#FFDD00;">vs</span> {{ $nombreDos }}
                  </td>
                </tr>
                <tr>
                  <td align="center" style="padding:0 15px 18px 15px; font-size:14px; text-transform:capitalize;">
                    {{ $fechaPartido }}
                    <span style="display:block; font-size:11px; opacity:.85; text-transform:none; margin-top:4px;">(hora de Guatemala)</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td align="center" style="padding:5px 30px 25px 30px;">
              <a
                  href="{{ url('/quiniela') }}"
                  target="_blank"
                  style="display:inline-block; background:#9fc822; color:#FFFFFF; text-decoration:none; font-weight:bold; padding:14px 28px; border-radius:8px; font-size:15px;"
              >
                Ingresar mi predicción
              </a>
            </td>
          </tr>

          <tr>
            <td style="padding:0 30px 25px 30px; color:#101820; font-size:15px; line-height:1.6;">
              Med Pharma
            </td>
          </tr>

          <tr>
            <td align="center" style="padding:15px 20px; background:#01665e; color:#FFFFFF; font-size:14px;">
              Quiniela Medpharma
            </td>
          </tr>

        </table>

      </td>
    </tr>
  </table>

</body>
</html>
