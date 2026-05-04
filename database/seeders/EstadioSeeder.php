<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estadios = [
            [
                'nombre' => 'BMO Field - Toronto',
                'descripcion' => 'Es el primer estadio construido específicamente para fútbol en Canadá, ubicado en el histórico Exhibition Place de Toronto. Hogar del Toronto FC, cuenta con una capacidad regular de 30,000 espectadores, pero será ampliado temporalmente a más de 45,000 asientos para albergar múltiples encuentros de la Copa Mundial de la FIFA 2026. Reconocido por su ambiente vibrante a orillas del lago Ontario, este recinto combina una profunda pasión futbolera con instalaciones modernas y de primer nivel.',
                'imagen' => '/images/estadios/bmo_field.jpg',
                'created_at' => (Carbon::now())->toDateTimeString()
            ],
            [
                'nombre' => 'Estadio BC Place - Vancouver',
                'descripcion' => 'Estadio icónico ubicado en el corazón de Vancouver, famoso por su espectacular techo retráctil sostenido por cables, considerado uno de los más grandes del mundo. Con una capacidad para más de 54,000 espectadores, es un recinto multipropósito de primer nivel. Histórico por albergar los Juegos Olímpicos de 2010 y la final del Mundial Femenino de 2015, el BC Place será uno de los escenarios más imponentes de Canadá para el Mundial 2026, destacando por su tecnología de vanguardia y su pantalla central suspendida.',
                'imagen' => '/images/estadios/bc_place.jpg',
                'created_at' => (Carbon::now())->toDateTimeString()
            ],
            [
                'nombre' => 'Estadio Azteca – Ciudad de México',
                'descripcion' => 'Considerado un verdadero templo del fútbol mundial y el estadio más grande de México, con capacidad para más de 83,000 espectadores. Su legado es inigualable: será el primer recinto en la historia en albergar partidos e inauguraciones de tres Copas Mundiales de la FIFA (1970, 1986 y 2026). Escenario emblemático donde se consagraron leyendas como Pelé y Maradona, el "Coloso de Santa Úrsula" combina una inmensa herencia histórica con imponentes modernizaciones para mantenerse como un ícono global del deporte.',
                'imagen' => '/images/estadios/estadio_azteca.jpg',
                'created_at' => (Carbon::now())->toDateTimeString()
            ],
            [
                'nombre' => 'Estadio Akron – Guadalajara',
                'descripcion' => 'Reconocido por su innovadora arquitectura en forma de volcán que se integra armoniosamente con el paisaje, es uno de los recintos más modernos y sustentables de América Latina. Hogar del histórico club Chivas, tiene una capacidad para cerca de 48,000 espectadores. Gracias a su diseño ecológico de captación de agua de lluvia, tecnología de punta y excelente acústica, el "Estadio Guadalajara" ofrecerá una experiencia de vanguardia como sede de la Copa Mundial de la FIFA 2026.',
                'imagen' => '/images/estadios/estadio_akron.jpg',
                'created_at' => (Carbon::now())->toDateTimeString()
            ],
            [
                'nombre' => 'Estadio BBVA – Monterrey',
                'descripcion' => 'Conocido popularmente como el "Gigante de Acero", es uno de los estadios más modernos e impresionantes del continente. Tiene una capacidad para más de 51,000 espectadores y destaca mundialmente por la majestuosa vista al icónico Cerro de la Silla que ofrece desde sus gradas. Inaugurado en 2015 con tecnología de última generación, cercanía extrema a la cancha y certificación ecológica, el "Estadio Monterrey" será una sede espectacular para la Copa Mundial de la FIFA 2026, combinando lujo, pasión y un entorno natural inigualable.',
                'imagen' => '/images/estadios/estadio_bbva.jpg',
                'created_at' => (Carbon::now())->toDateTimeString()
            ],
            [
                'nombre' => 'Estadio Mercedes-Benz – Atlanta',
                'descripcion' => 'Famoso por su icónico techo retráctil en forma de diafragma y su impresionante pantalla de video circular de 360 grados (Halo Board), es una verdadera obra maestra de la arquitectura deportiva. Con capacidad para más de 71,000 espectadores, este recinto de alta tecnología y máxima certificación sustentable será rebautizado como "Estadio de Atlanta" durante el Mundial 2026. Elegido para albergar partidos clave, incluyendo una de las semifinales del torneo, ofrece una de las experiencias visuales más inmersivas y modernas del mundo.',
                'imagen' => '/images/estadios/estadio_mercedes_benz.jpg',
                'created_at' => (Carbon::now())->toDateTimeString()
            ],
            [
                'nombre' => 'Estadio Gillette – Boston',
                'descripcion' => 'Situado en Foxborough, a las afueras de Boston, es el majestuoso recinto al aire libre hogar del New England Revolution y los Patriots. Con capacidad para cerca de 65,000 espectadores, destaca por su renovada arquitectura que incluye su icónico y monumental faro de observación. Combinando una arraigada tradición deportiva de clase mundial con instalaciones de primer nivel, el "Estadio de Boston" aportará su vibrante atmósfera como una sede fundamental para la Copa Mundial de la FIFA 2026.',
                'imagen' => '/images/estadios/estadio_gillete.jpg',
                'created_at' => (Carbon::now())->toDateTimeString()
            ],
            [
                'nombre' => 'Estadio AT&T – Texas',
                'descripcion' => 'Considerado una verdadera maravilla arquitectónica y uno de los recintos cerrados más grandes del mundo, cuenta con una capacidad de 80,000 espectadores (ampliable a más de 100,000). Famoso por su gigantesca pantalla central suspendida, monumentales puertas de cristal y techo retráctil, es un palacio absoluto del entretenimiento deportivo. Bajo el nombre de "Estadio de Dallas", será un escenario colosal y la sede más activa de la Copa Mundial de la FIFA 2026, albergando la mayor cantidad de partidos de todo el torneo.',
                'imagen' => '/images/estadios/estadio_att.jpg',
                'created_at' => (Carbon::now())->toDateTimeString()
            ],
            [
                'nombre' => 'Estadio NRG – Texas',
                'descripcion' => 'Pionero en la arquitectura deportiva al ser el primer estadio de fútbol americano profesional en contar con un techo retráctil, este recinto ofrece un ambiente completamente climatizado, una característica vital para el verano texano. Con capacidad para más de 72,000 espectadores, destaca por su inmensa versatilidad y excelentes líneas de visión. Designado como "Estadio de Houston" para la Copa Mundial de la FIFA 2026, garantizará una experiencia cómoda, moderna y espectacular en cada uno de sus emocionantes encuentros.',
                'imagen' => '/images/estadios/estadio_nrg.jpg',
                'created_at' => (Carbon::now())->toDateTimeString()
            ],
            [
                'nombre' => 'Estadio Arrowhead – Missouri',
                'descripcion' => 'Reconocido a nivel mundial por poseer el récord Guinness como el estadio al aire libre más ruidoso del mundo, es el legendario hogar de los Kansas City Chiefs de la NFL. Con una capacidad adaptada para recibir a más de 73,000 espectadores, este imponente recinto será bautizado temporalmente como "Estadio de Kansas City". Su atmósfera verdaderamente eléctrica y su rica herencia deportiva lo convertirán en un escenario temible y crucial para la Copa Mundial de la FIFA 2026, donde albergará seis emocionantes encuentros, incluyendo un choque decisivo de cuartos de final que seguramente definirá el rumbo de muchas quinielas.',
                'imagen' => '/images/estadios/estadio_arrowhead.jpg',
                'created_at' => (Carbon::now())->toDateTimeString()
            ],
            [
                'nombre' => 'Estadio SoFi – Los Angeles',
                'descripcion' => 'Considerado el estadio más caro jamás construido y una joya absoluta de la ingeniería moderna, este recinto ubicado en Inglewood redefine el concepto de diseño "indoor-outdoor" con su gigantesco techo translúcido y estructura abierta. Con capacidad base para 70,000 espectadores, su característica más alucinante es la "Infinity Screen", una enorme pantalla circular de doble cara en 4K que suspende sobre el campo. Bajo el nombre de "Estadio de Los Ángeles", será una sede estelar e hipertecnológica para la Copa Mundial de la FIFA 2026, albergando el partido inaugural de la selección de Estados Unidos y prometiendo una experiencia visual y arquitectónica inigualable.',
                'imagen' => '/images/estadios/estadio_sofi.jpg',
                'created_at' => (Carbon::now())->toDateTimeString()
            ],
            [
                'nombre' => 'Estadio Hard Rock – Miami',
                'descripcion' => 'Famoso por su icónico techo de diseño abierto que protege del sol y la lluvia a la gran mayoría de los aficionados mientras mantiene el campo de juego al aire libre, es un epicentro global del entretenimiento deportivo y el lujo. Con una capacidad para aproximadamente 65,000 espectadores, este recinto será designado oficialmente como "Estadio de Miami". Sede de múltiples Super Bowls y eventos internacionales, su vibrante atmósfera tropical será el escenario perfecto para varios encuentros de la Copa Mundial de la FIFA 2026, incluyendo el gran duelo por el tercer lugar (la final de bronce).',
                'imagen' => '/images/estadios/estadio_hard_rock.jpg',
                'created_at' => (Carbon::now())->toDateTimeString()
            ],
            [
                'nombre' => 'Estadio MetLife – Nueva York/Nueva Jersey',
                'descripcion' => 'Situado en East Rutherford, sirviendo a la vibrante área metropolitana de Nueva York, es uno de los recintos de mayor aforo del torneo con capacidad para más de 82,000 espectadores. Este colosal estadio al aire libre, hogar de dos equipos de la NFL, será el epicentro absoluto del fútbol global. Bajo el nombre oficial de "Estadio de Nueva York/Nueva Jersey", ha sido el elegido para albergar el momento culminante y más esperado de todos: la Gran Final de la Copa Mundial de la FIFA 2026. Será el imponente escenario donde se levantará el trofeo, se coronará al nuevo campeón y el partido decisivo que definirá los resultados finales de la quiniela.',
                'imagen' => '/images/estadios/estadio_metlife.jpg',
                'created_at' => (Carbon::now())->toDateTimeString()
            ],
            [
                'nombre' => 'Estadio Lincoln Financial – Filadelfia',
                'descripcion' => 'Conocido popularmente como "The Linc", este majestuoso estadio al aire libre es el hogar de los Philadelphia Eagles de la NFL. Con una capacidad para cerca de 69,000 espectadores, destaca a nivel mundial por su impresionante infraestructura sostenible, siendo pionero en la generación de energía verde gracias a sus miles de paneles solares y turbinas eólicas integradas en su diseño. Bajo el nombre de "Estadio de Filadelfia", este recinto aportará una de las atmósferas más pasionales e intensas del deporte a la Copa Mundial de la FIFA 2026, celebrando el torneo en el corazón de una de las ciudades más históricas de Estados Unidos.',
                'imagen' => '/images/estadios/estadio_lincoln.jpg',
                'created_at' => (Carbon::now())->toDateTimeString()
            ],
            [
                'nombre' => 'Estadio Levi\'s – San Francisco',
                'descripcion' => 'Ubicado en Santa Clara, en el corazón tecnológico de Silicon Valley, es reconocido como uno de los estadios más inteligentes, conectados y ecológicos del mundo. Con una capacidad aproximada de 68,500 espectadores, este recinto destaca por su impresionante terraza que incluye un techo verde y paneles solares, siendo pionero en certificaciones de sostenibilidad. Bajo el nombre de "Estadio de la Bahía de San Francisco" para la Copa Mundial de la FIFA 2026, ofrecerá a los aficionados una experiencia de hiperconectividad y vanguardia total en cada uno de sus emocionantes encuentros.',
                'imagen' => '/images/estadios/estadio_levi.jpg',
                'created_at' => (Carbon::now())->toDateTimeString()
            ],
            [
                'nombre' => 'Estadio Lumen – Washington',
                'descripcion' => 'Famoso por su icónica arquitectura en forma de herradura que enmarca vistas espectaculares del horizonte de la ciudad y las aguas del Puget Sound, este recinto es uno de los más temidos por los equipos visitantes. Con capacidad para más de 68,000 espectadores, es un verdadero bastión futbolero en el noroeste del país, hogar de los Seattle Sounders de la MLS y los Seahawks de la NFL. Reconocido internacionalmente por la ensordecedora pasión de su afición y un diseño de techo que amplifica el ruido, el "Estadio de Seattle" será una sede espectacular y vibrante para la Copa Mundial de la FIFA 2026, albergando partidos clave de la fase de grupos para la selección de Estados Unidos.',
                'imagen' => '/images/estadios/estadio_lumen.jpg',
                'created_at' => (Carbon::now())->toDateTimeString()
            ]
        ];

        DB::table('estadios')->insert($estadios);
    }
}
