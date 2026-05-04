<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Restablece tu contraseña</title>
</head>
<body style="margin:0; padding:0; background-color:#f1f3f7; font-family: Arial, Helvetica, sans-serif; color:#101820;">

    <!-- Preheader (texto oculto que se muestra como vista previa en algunos clientes) -->
    <div style="display:none; max-height:0; overflow:hidden; mso-hide:all;">
        Restablece tu contraseña de la Quiniela Medpharma. El enlace expira pronto.
    </div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f1f3f7;">
        <tr>
            <td align="center" style="padding:32px 16px;">

                <!-- Card principal -->
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="width:100%; max-width:600px; background-color:#ffffff; border-radius:16px; overflow:hidden; box-shadow:0 6px 24px rgba(16,24,32,0.08);">

                    <!-- Header con color primario -->
                    <tr>
                        <td align="center" style="background-color:#FFFFFF; padding:36px 24px 28px 24px;">
                            <img
                                src="{{ rtrim(config('app.url'), '/') . '/images/logos/logo-quiniela.png' }}"
                                alt="{{ config('app.name', 'Quiniela Medpharma') }}"
                                width="280"
                                style="display:block; width:280px; max-width:100%; height:auto; margin:0 auto;"
                            >
                        </td>
                    </tr>

                    <!-- Acento amarillo -->
                    <tr>
                        <td style="height:6px; background-color:#01665e; line-height:6px; font-size:0;">&nbsp;</td>
                    </tr>

                    <!-- Título -->
                    <tr>
                        <td style="padding:36px 36px 8px 36px;">
                            <h1 style="margin:0; font-size:24px; line-height:1.3; color:#01665e; font-weight:700;">
                                Restablece tu contraseña
                            </h1>
                        </td>
                    </tr>

                    <!-- Saludo -->
                    <tr>
                        <td style="padding:16px 36px 0 36px;">
                            <p style="margin:0; font-size:16px; line-height:1.6; color:#101820;">
                                Hola {{ ($user?->nombres ?? '') }},
                            </p>
                        </td>
                    </tr>

                    <!-- Mensaje -->
                    <tr>
                        <td style="padding:12px 36px 0 36px;">
                            <p style="margin:0; font-size:15px; line-height:1.7; color:#101820;">
                                Recibimos una solicitud para restablecer la contraseña de tu cuenta. Haz clic en el siguiente botón para crear una nueva contraseña:
                            </p>
                        </td>
                    </tr>

                    <!-- Botón CTA -->
                    <tr>
                        <td align="center" style="padding:28px 36px 8px 36px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" bgcolor="#01665e" style="border-radius:10px;">
                                        <a href="{{ $url }}"
                                           target="_blank"
                                           style="display:inline-block; padding:14px 36px; font-family: Arial, Helvetica, sans-serif; font-size:15px; font-weight:bold; color:#FFFFFF; text-decoration:none; border-radius:10px; letter-spacing:0.3px;">
                                            Restablecer contraseña
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Aviso de expiración -->
                    <tr>
                        <td style="padding:8px 36px 0 36px;">
                            <p style="margin:0; font-size:13px; line-height:1.6; color:#63666A; text-align:center;">
                                Este enlace expirará en {{ $expireMinutes }} minutos.
                            </p>
                        </td>
                    </tr>

                    <!-- Separador -->
                    <tr>
                        <td style="padding:28px 36px 0 36px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="border-top:1px solid #e5e7eb; line-height:1px; font-size:0;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Enlace alternativo -->
                    <tr>
                        <td style="padding:20px 36px 0 36px;">
                            <p style="margin:0 0 8px 0; font-size:13px; line-height:1.6; color:#63666A;">
                                Si el botón no funciona, copia y pega esta URL en tu navegador:
                            </p>
                            <p style="margin:0; font-size:13px; line-height:1.6; word-break:break-all;">
                                <a href="{{ $url }}" target="_blank" style="color:#2b336b; text-decoration:underline;">{{ $url }}</a>
                            </p>
                        </td>
                    </tr>

                    <!-- Nota de seguridad -->
                    <tr>
                        <td style="padding:24px 36px 0 36px;">
                            <p style="margin:0; font-size:13px; line-height:1.6; color:#63666A;">
                                Si no solicitaste restablecer tu contraseña, puedes ignorar este correo de forma segura. Tu contraseña actual seguirá funcionando.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:32px 36px 32px 36px;">
                            <p style="margin:0; font-size:12px; line-height:1.6; color:#63666A; text-align:center;">
                                &copy; {{ date('Y') }} {{ config('app.name', 'Quiniela Medpharma') }}.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
