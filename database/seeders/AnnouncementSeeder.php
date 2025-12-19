<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $announcements = [
            // Académico (category_id: 1)
            ['title' => 'Inicio del curso escolar 2025', 'content' => 'Les informamos que el curso escolar 2025 comenzará el próximo lunes 8 de enero. Los alumnos deberán presentarse a las 8:00 AM.', 'category_id' => 1, 'urgent' => true],
            ['title' => 'Entrega de notas del primer trimestre', 'content' => 'La entrega de notas del primer trimestre se realizará el viernes 15 de diciembre en horario de 16:00 a 19:00.', 'category_id' => 1, 'urgent' => false],
            ['title' => 'Cambio de horario de tutorías', 'content' => 'A partir del próximo mes, las tutorías se realizarán los martes y jueves de 17:00 a 18:00.', 'category_id' => 1, 'urgent' => false],
            ['title' => 'Exámenes finales - Calendario', 'content' => 'El calendario de exámenes finales ya está disponible en la secretaría. Consulta las fechas y prepárate con tiempo.', 'category_id' => 1, 'urgent' => true],

            // Eventos (category_id: 2)
            ['title' => 'Festival de Navidad 2024', 'content' => 'El próximo 22 de diciembre celebraremos nuestro tradicional Festival de Navidad. Las familias están invitadas a partir de las 11:00.', 'category_id' => 2, 'urgent' => false],
            ['title' => 'Excursión al Museo de Ciencias', 'content' => 'El día 20 de enero realizaremos una excursión al Museo de Ciencias. El coste es de 15€ por alumno incluyendo transporte y entrada.', 'category_id' => 2, 'urgent' => false],
            ['title' => 'Jornada de puertas abiertas', 'content' => 'El sábado 25 de enero celebraremos nuestra jornada de puertas abiertas para nuevas familias interesadas.', 'category_id' => 2, 'urgent' => false],
            ['title' => 'Semana Cultural 2025', 'content' => 'Del 10 al 14 de febrero celebraremos nuestra Semana Cultural con talleres, exposiciones y actividades especiales.', 'category_id' => 2, 'urgent' => false],

            // Deportes (category_id: 3)
            ['title' => 'Inscripción actividades extraescolares deportivas', 'content' => 'Ya está abierto el plazo de inscripción para fútbol, baloncesto, natación y gimnasia rítmica. Plazas limitadas.', 'category_id' => 3, 'urgent' => false],
            ['title' => 'Torneo interescolar de fútbol', 'content' => 'Nuestro equipo participará en el torneo interescolar el próximo sábado. ¡Animad a nuestros jugadores!', 'category_id' => 3, 'urgent' => false],
            ['title' => 'Nuevo equipamiento deportivo', 'content' => 'Hemos renovado el equipamiento del gimnasio con nuevos materiales de psicomotricidad y deportes colectivos.', 'category_id' => 3, 'urgent' => false],
            ['title' => 'Carrera solidaria escolar', 'content' => 'El 15 de marzo organizamos nuestra carrera solidaria anual. Los fondos irán destinados a proyectos de cooperación.', 'category_id' => 3, 'urgent' => false],

            // Cultura (category_id: 4)
            ['title' => 'Concurso de redacción literaria', 'content' => 'Convocamos el concurso anual de redacción. Tema: "Mi lugar favorito". Fecha límite de entrega: 28 de febrero.', 'category_id' => 4, 'urgent' => false],
            ['title' => 'Visita del autor Juan García', 'content' => 'El escritor Juan García visitará nuestro centro el 5 de febrero para hablar sobre su nueva novela juvenil.', 'category_id' => 4, 'urgent' => false],
            ['title' => 'Exposición de arte del alumnado', 'content' => 'Del 1 al 15 de marzo expondremos los trabajos artísticos realizados durante el trimestre en el hall principal.', 'category_id' => 4, 'urgent' => false],
            ['title' => 'Taller de teatro abierto', 'content' => 'Comenzamos un nuevo taller de teatro los viernes de 16:00 a 18:00. Abierto a todos los cursos.', 'category_id' => 4, 'urgent' => false],

            // Administración (category_id: 5)
            ['title' => 'Período de matriculación abierto', 'content' => 'El período de matriculación para el curso 2025-2026 estará abierto del 1 al 31 de marzo en secretaría.', 'category_id' => 5, 'urgent' => true],
            ['title' => 'Actualización de datos de contacto', 'content' => 'Rogamos a las familias que actualicen sus datos de contacto en secretaría antes del 31 de enero.', 'category_id' => 5, 'urgent' => false],
            ['title' => 'Nuevo sistema de comunicación', 'content' => 'A partir de febrero utilizaremos la app TokApp para comunicaciones oficiales. Descárgala y regístrate.', 'category_id' => 5, 'urgent' => true],
            ['title' => 'Horario de secretaría en vacaciones', 'content' => 'Durante las vacaciones de Navidad, la secretaría estará abierta los días 27, 28 y 29 de diciembre de 9:00 a 13:00.', 'category_id' => 5, 'urgent' => false],

            // Becas y Ayudas (category_id: 6)
            ['title' => 'Becas de comedor escolar 2025', 'content' => 'Plazo abierto para solicitar becas de comedor. Requisitos y formularios disponibles en secretaría.', 'category_id' => 6, 'urgent' => true],
            ['title' => 'Ayudas para material escolar', 'content' => 'Las familias que lo necesiten pueden solicitar ayudas para material escolar. Consulta los requisitos en secretaría.', 'category_id' => 6, 'urgent' => false],
            ['title' => 'Becas de excelencia académica', 'content' => 'Convocamos becas de excelencia para alumnos con media superior a 8.5. Presentar solicitud antes del 20 de enero.', 'category_id' => 6, 'urgent' => false],
            ['title' => 'Programa de apoyo escolar gratuito', 'content' => 'Ofrecemos clases de refuerzo gratuitas para alumnos con dificultades. Información en jefatura de estudios.', 'category_id' => 6, 'urgent' => false],

            // Horarios (category_id: 7)
            ['title' => 'Horario especial por obras', 'content' => 'Debido a obras de mejora, la entrada se realizará por la puerta lateral durante la próxima semana.', 'category_id' => 7, 'urgent' => true],
            ['title' => 'Modificación horario biblioteca', 'content' => 'La biblioteca abrirá en horario ampliado de 8:00 a 18:00 durante el período de exámenes.', 'category_id' => 7, 'urgent' => false],
            ['title' => 'Horario de atención a padres', 'content' => 'Recordamos que el horario de atención a padres es de lunes a viernes de 9:00 a 10:00 y de 13:00 a 14:00.', 'category_id' => 7, 'urgent' => false],

            // Convocatorias (category_id: 8)
            ['title' => 'Reunión de padres - Educación Primaria', 'content' => 'Convocamos reunión de padres de Primaria el jueves 18 de enero a las 17:00 en el salón de actos.', 'category_id' => 8, 'urgent' => true],
            ['title' => 'Elecciones al Consejo Escolar', 'content' => 'El próximo 30 de noviembre se celebrarán elecciones al Consejo Escolar. Consulta las candidaturas en el tablón.', 'category_id' => 8, 'urgent' => false],
            ['title' => 'Asamblea general AMPA', 'content' => 'La AMPA convoca asamblea general ordinaria el día 20 de enero a las 18:00. Se ruega confirmación de asistencia.', 'category_id' => 8, 'urgent' => false],
        ];

        foreach ($announcements as $data) {
            Announcement::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'content' => $data['content'],
                'category_id' => $data['category_id'],
                'user_id' => rand(1, 11), // Admin (1) o Tutores (2-11)
                'urgent' => $data['urgent'],
            ]);
        }
    }
}
