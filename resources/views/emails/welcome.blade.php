<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienvenido a Quiniela Medpharma</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, Helvetica, sans-serif; color:#000000;">

  <table width="100%" cellpadding="0" cellspacing="0" style="padding:30px 0;">
    <tr>
      <td align="center">

        <!-- Contenedor principal -->
        <table width="600" cellpadding="0" cellspacing="0" style="width:600px; max-width:600px; background:#FFFFFF; border-radius:10px; overflow:hidden;">

          <!-- Logo -->
          <tr>
            <td align="center" style="padding:30px 20px 10px 20px;">
              <img
                src="{{ rtrim(config('app.url'), '/') . '/images/logos/medpharma-logo.jpg' }}"
                alt="Medpharma"
                width="320"
                style="display:block; max-width:320px; height:auto;"
              >
            </td>
          </tr>

          <!-- Bienvenida -->
          <tr>
            <td style="padding:20px 30px;">
              <h2 style="margin:0; font-size:22px; color:#01665e;">
                ¡Bienvenido{{ isset($user->nombres) && $user->nombres ? ', ' . $user->nombres : '' }}!
              </h2>

              <p style="margin:15px 0 0 0; font-size:15px; line-height:1.6;">
                Tu registro en la Quiniela Medpharma ha sido exitoso. Prepárate para vivir la emoción del Mundial 2026.
              </p>
            </td>
          </tr>

          <!-- Despedida -->
          <tr>
            <td style="padding:20px 30px 10px 30px;">
              <p style="margin:0; font-size:14px; line-height:1.7;">
                Atentamente,
              </p>
              <p style="margin:0; font-size:14px; line-height:1.7;">
                {{ config('app.name') }}
              </p>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="padding:15px 30px; font-size:12px; text-align:center;">
              &copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
            </td>
          </tr>

        </table>

      </td>
    </tr>
  </table>

</body>
</html>
