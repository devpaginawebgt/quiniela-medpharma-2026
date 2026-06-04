<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $customSubject ?? 'System Notification' }}</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, Helvetica, sans-serif; color:#FFFFFF;">

  <table width="100%" cellpadding="0" cellspacing="0" style="padding:30px 0; background:#FFFFFF;">
    <tr>
      <td align="center">

        <table width="600" cellpadding="0" cellspacing="0" style="width:600px; max-width:600px; background:#FFFFFF; border-radius:10px; overflow:hidden;">

          <tr>
            <td align="center" style="padding:30px 20px 10px 20px; border-bottom: 3px solid #01665e;">
              <img src="{{ asset('images/logos/logo-quiniela.png') }}" alt="Quiniela Medpharma" width="200" style="display:block; max-width:200px; height:auto; border:0; outline:none; text-decoration:none;">
            </td>
          </tr>

          {{-- <tr>
            <td align="center" style="padding:10px 20px 10px 20px; color:#000000; font-size:18px; font-weight:bold;">
              Quiniela Medpharma
            </td>
          </tr> --}}

          <tr>
            <td style="padding:20px 30px 30px 30px; color:#000000; font-size:15px; line-height:1.6;">
              {!! nl2br(e($body)) !!}
            </td>
          </tr>

          <tr>
            <td align="center" style="padding:15px 20px; background:#01665e; color:#FFFFFF; font-size:12px;">
              Quiniela Medpharma · Notificación del sistema
            </td>
          </tr>

        </table>

      </td>
    </tr>
  </table>

</body>
</html>
