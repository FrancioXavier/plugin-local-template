<?php

/**
 * @package  auto_cohort
 * @copyright 2017, Mohammed Essaid MEZERREG <me@mohessaid.com>
 * @license MIT
 * @doc https://docs.moodle.org/dev/Events_API
 */

// Event handlers (subscriptions) are defined here. It lists all the events that your plugin want to observe and be notified about.
 
defined('MOODLE_INTERNAL') || die();

$observers = array(
    array(
        'eventname'   => '\core\event\course_created',
        'callback'    => 'local_auto_cohort_course_created',
        'includefile' => '/local/auto_cohort/lib.php',
        'priority'    => 1000,
        'internal'    => false,
    ),
);

