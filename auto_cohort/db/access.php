<?php

/**
 * @package  auto_cohort
 * @copyright 2017, Mohammed Essaid MEZERREG <me@mohessaid.com>
 * @license MIT
 * @doc https://docs.moodle.org/dev/Access_API
 */

// If you change this file, you must upgrade the plugin version inorder for your
// changes to take effect.
 
defined('MOODLE_INTERNAL') || die();

$capabilities = array(
    'local/auto_cohort:manage' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
            'manager' => CAP_ALLOW,
        ),
    ),
);