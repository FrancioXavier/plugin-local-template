<?php
namespace local_auto_cohort\event;

defined('MOODLE_INTERNAL') || die();

use core\event\base;

class cohort_created extends base {

    protected function init() {
        $this->data['crud'] = 'c'; // Create
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
        $this->data['objecttable'] = 'cohort';
    }

    public static function get_name() {
        return get_string('eventcohortcreated', 'local_auto_cohort');
    }

    public function get_description() {
        return "The user with id '{$this->userid}' created a cohort with id '{$this->objectid}'.";
    }

    public function get_url() {
        return new \moodle_url('/cohort/view.php', array('id' => $this->objectid));
    }

    protected function get_legacy_logdata() {
        return array($this->courseid, 'cohort', 'create', 'view.php?id='.$this->objectid, $this->objectid, $this->contextinstanceid);
    }
}
