<?php

/**
 * @package  auto_cohort
 * @copyright 2017, Mohammed Essaid MEZERREG <me@mohessaid.com>
 * @license MIT
 * @doc https://docs.moodle.org/dev/Plugin_files
 */
 
defined('MOODLE_INTERNAL') || die();

function local_auto_cohort_course_created(\core\event\course_created $event) {
    global $DB;

    $courseid = $event->objectid;
    $course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);

    // Cria o cohort
    $cohort = new stdClass();
    $cohort->name = 'Cohort ' . $course->fullname;
    $cohort->contextid = context_course::instance($courseid)->id;
    $cohort->idnumber = 'cohort_' . $courseid;
    $cohort->component = 'local_auto_cohort';
    $cohort->description = 'Cohort automatically created for course ' . $course->fullname;
    $cohort->descriptionformat = FORMAT_HTML;
    $cohort->visible = 1;
    $cohort->timecreated = time();
    $cohort->timemodified = time();

    $cohortid = $DB->insert_record('cohort', $cohort);

    // Sincronizar cohort ao curso
    enrol_cohort_to_course($cohortid, $courseid);

    // Registra o evento de criação do cohort
    $eventdata = array(
        'context' => \context_course::instance($courseid),
        'objectid' => $cohortid,
        'other' => array('name' => $cohort->name)
    );
    $event = \local_auto_cohort\event\cohort_created::create($eventdata);
    $event->trigger();

    // Adiciona uma mensagem de log
    \core\notification::add(get_string('auto_cohort:created', 'local_auto_cohort', array('name' => $cohort->name, 'course' => $course->fullname)));
}

/**
 * Função para inscrever um cohort em um curso.
 *
 * @param int $cohortid O ID do cohort.
 * @param int $courseid O ID do curso.
 */
function enrol_cohort_to_course($cohortid, $courseid) {
    global $DB;

    // Verifica se o plugin de inscrição de cohort está habilitado
    if (!$enrol = enrol_get_plugin('cohort')) {
        throw new coding_exception('Cohort enrolment plugin not enabled');
    }

    $course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
    $context = context_course::instance($course->id);

    // Verifica se o método de inscrição de cohort já existe no curso
    if (!$instance = $DB->get_record('enrol', array('courseid' => $course->id, 'enrol' => 'cohort', 'customint1' => $cohortid))) {
        // Cria uma nova instância de inscrição de cohort
        $fields = array(
            'status' => ENROL_INSTANCE_ENABLED,
            'name' => 'Cohort sync for ' . $course->fullname,
            'roleid' => 5, // ID do papel de estudante
            'customint1' => $cohortid
        );
        $enrol->add_instance($course, $fields);
    }
}

