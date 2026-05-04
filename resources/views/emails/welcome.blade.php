<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bienvenido a {{ config('app.name', 'Quiniela Medpharma') }}</title>
</head>
<body style="margin:0; padding:0; background-color:#f1f3f7; font-family: Arial, Helvetica, sans-serif; color:#101820;">

    @php
        $baseUrl = rtrim(config('app.url'), '/');
        $loginUrl = $baseUrl . '/ingresa';
        $sections = [
            [
                'label' => 'Inicio',
                'desc'  => 'Tu punto de partida con información sobre el mundial.',
                'path'  => '/inicio',
            ],
            [
                'label' => 'Selecciones',
                'desc'  => 'Conoce a los paises participantes y revisa información importante sobre cada selección.',
                'path'  => '/selecciones',
            ],
            [
                'label' => 'Grupos',
                'desc'  => 'Explora la conformación de grupos y los equipos que los integran.',
                'path'  => '/grupos',
            ],
            [
                'label' => 'Estadios',
                'desc'  => 'Descubre las sedes que recibirán los partidos del torneo.',
                'path'  => '/estadios',
            ],
            [
                'label' => 'Calendario y Quiniela',
                'desc'  => 'Consulta el calendario de partidos, registra tus pronósticos y gana puntos por tus aciertos.',
                'path'  => '/quiniela',
            ],
            [
                'label' => 'Tabla de resultados',
                'desc'  => 'Sigue tu avance y el de los demás participantes a lo largo del torneo.',
                'path'  => '/tabla-de-resultados',
            ],
            [
                'label' => 'Premios',
                'desc'  => 'Conoce los reconocimientos disponibles para los mejores puestos.',
                'path'  => '/tabla-de-premios',
            ],
        ];
    @endphp

    <!-- Preheader -->
    <div style="display:none; max-height:0; overflow:hidden; mso-hide:all;">
        ¡Te damos la bienvenida a la Quiniela Medpharma! Aquí tienes todo lo que necesitas para empezar.
    </div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f1f3f7;">
        <tr>
            <td align="center" style="padding:32px 16px;">

                <!-- Card principal -->
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="width:100%; max-width:600px; background-color:#ffffff; border-radius:16px; overflow:hidden; box-shadow:0 6px 24px rgba(16,24,32,0.08);">

                    <!-- Header con logo -->
                    <tr>
                        <td align="center" style="background-color:#FFFFFF; padding:36px 24px 28px 24px;">
                            <img
                                src="{{ $baseUrl . '/images/logos/logo-quiniela.png' }}"
                                alt="{{ config('app.name', 'Quiniela Medpharma') }}"
                                width="280"
                                style="display:block; width:280px; max-width:100%; height:auto; margin:0 auto;"
                            >
                        </td>
                    </tr>

                    <!-- Acento -->
                    <tr>
                        <td style="height:6px; background-color:#01665e; line-height:6px; font-size:0;">&nbsp;</td>
                    </tr>

                    <!-- Título -->
                    <tr>
                        <td style="padding:36px 36px 8px 36px;">
                            <h1 style="margin:0; font-size:24px; line-height:1.3; color:#01665e; font-weight:700;">
                                ¡Te damos la bienvenida{{ isset($user->nombres) && $user->nombres ? ', ' . e($user->nombres) : '' }}!
                            </h1>
                        </td>
                    </tr>

                    <!-- Mensaje -->
                    <tr>
                        <td style="padding:16px 36px 0 36px;">
                            <p style="margin:0; font-size:15px; line-height:1.7; color:#101820;">
                                Tu registro en la Quiniela Medpharma fue exitoso. Nos alegra contar con tu participación: queremos que esta experiencia sea, sobre todo, una forma divertida y respetuosa de compartir el gusto por el fútbol.
                            </p>
                            <p style="margin:14px 0 0 0; font-size:15px; line-height:1.7; color:#101820;">
                                Te invitamos a disfrutarla con espíritu de comunidad, celebrando los aciertos propios y los de los demás.
                            </p>
                        </td>
                    </tr>

                    <!-- Acceso: QR + URL -->
                    <tr>
                        <td style="padding:28px 36px 0 36px;">
                            <h2 style="margin:0 0 12px 0; font-size:18px; line-height:1.3; color:#01665e; font-weight:700;">
                                Cómo ingresar
                            </h2>
                            <p style="margin:0 0 16px 0; font-size:14px; line-height:1.7; color:#101820;">
                                Puedes entrar escaneando el siguiente código QR desde tu celular, o usando el enlace de acceso directo.
                            </p>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" style="padding:8px 0 16px 0;">
                                        <img
                                            src="{{ $baseUrl . '/images/decoracion/qr-code-login.png' }}"
                                            alt="Código QR para ingresar"
                                            width="200"
                                            style="display:block; width:200px; max-width:60%; height:auto; margin:0 auto; border:1px solid #e5e7eb; border-radius:8px;"
                                        >
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td align="center" bgcolor="#01665e" style="border-radius:10px;">
                                                    <a href="{{ $loginUrl }}"
                                                       target="_blank"
                                                       style="display:inline-block; padding:14px 36px; font-family: Arial, Helvetica, sans-serif; font-size:15px; font-weight:bold; color:#FFFFFF; text-decoration:none; border-radius:10px; letter-spacing:0.3px;">
                                                        Ir a la plataforma
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding:12px 0 0 0;">
                                        <p style="margin:0; font-size:12px; line-height:1.6; word-break:break-all; color:#63666A;">
                                            <a href="{{ $loginUrl }}" target="_blank" style="color:#2b336b; text-decoration:none;">{{ $loginUrl }}</a>
                                        </p>
                                    </td>
                                </tr>
                            </table>
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

                    <!-- Recorrido por la plataforma -->
                    <tr>
                        <td style="padding:24px 36px 0 36px;">
                            <h2 style="margin:0 0 12px 0; font-size:18px; line-height:1.3; color:#01665e; font-weight:700;">
                                Qué encontrarás en la quiniela:
                            </h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:8px 36px 0 36px;">
                            @foreach ($sections as $section)
                                <p style="margin:0 0 10px 0; font-size:14px; line-height:1.7; color:#101820;">
                                    <span style="color:#01665e; font-weight:700; margin-right:4px;">&gt;</span>
                                    <a href="{{ $baseUrl . $section['path'] }}" target="_blank" style="color:#01665e; text-decoration:none; font-weight:700;">{{ $section['label'] }}:</a>
                                    {{ $section['desc'] }}
                                </p>
                            @endforeach
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

                    <!-- Sistema de puntos -->
                    <tr>
                        <td style="padding:24px 36px 0 36px;">
                            <h2 style="margin:0 0 12px 0; font-size:18px; line-height:1.3; color:#01665e; font-weight:700;">
                                Sistema de puntos
                            </h2>
                            <p style="margin:0 0 12px 0; font-size:14px; line-height:1.7; color:#101820;">
                                Los puntos se calculan con el marcador oficial al final de los 90 minutos reglamentarios (más tiempo de reposición).
                            </p>

                            <p style="margin:0 0 8px 0; font-size:14px; line-height:1.7; color:#101820;">
                                <span style="color:#01665e; font-weight:700; margin-right:4px;">-</span>
                                <span style="color:#01665e; font-weight:700;">5 puntos:</span> marcador exacto (acertar goles de ambos equipos).
                            </p>
                            <p style="margin:0 0 8px 0; font-size:14px; line-height:1.7; color:#101820;">
                                <span style="color:#01665e; font-weight:700; margin-right:4px;">-</span>
                                <span style="color:#01665e; font-weight:700;">4 puntos:</span> acertar al ganador y el marcador de uno de los equipos.
                            </p>
                            <p style="margin:0 0 8px 0; font-size:14px; line-height:1.7; color:#101820;">
                                <span style="color:#01665e; font-weight:700; margin-right:4px;">-</span>
                                <span style="color:#01665e; font-weight:700;">2 puntos:</span> acertar solo al ganador o el empate, sin acertar los goles.
                            </p>
                            <p style="margin:0 0 8px 0; font-size:14px; line-height:1.7; color:#101820;">
                                <span style="color:#01665e; font-weight:700; margin-right:4px;">-</span>
                                <span style="color:#01665e; font-weight:700;">1 punto:</span> acertar los goles de uno de los equipos sin acertar al ganador.
                            </p>
                        </td>
                    </tr>

                    <!-- Cierre -->
                    <tr>
                        <td style="padding:28px 36px 0 36px;">
                            <p style="margin:0; font-size:14px; line-height:1.7; color:#101820;">
                                Recuerda que se trata de una participación amistosa entre colegas. Lo importante es disfrutarla en buena compañía.
                            </p>
                            <p style="margin:14px 0 0 0; font-size:14px; line-height:1.7; color:#101820;">
                                ¡Mucha suerte y buen Mundial!
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:28px 36px 32px 36px;">
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
