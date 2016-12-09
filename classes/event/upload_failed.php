<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * The mod_turnitintool submission submitted event.
 *
 * @package    mod_turnitintool
 * @copyright  2015 Blackboard
 * @author     Adam Olley <adam.olley@blackboard.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_turnitintool\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The mod_turnitintool submission upload failed event class.
 *
 * @property-read array $other {
 *      title
 *      errorcode
 * }
 *
 * @package    mod_turnitintool
 * @since      Moodle 2.9
 * @copyright  2014 NetSpot Pty Ltd
 * @author     Adam Olley <adam.olley@netspot.com.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class upload_failed extends \core\event\base {

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_OTHER;
        $this->data['objecttable'] = 'turnitintool_submissions';
    }

    public function get_description() {
        return "Upload to Turnitin failed for '".$this->other['title']."'. Error code: ".$this->other['errorcode'];
    }

    public static function get_name() {
        return get_string('eventuploadfailed', 'mod_turnitintool');
    }

    /**
     * Get URL related to the action.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/mod/turnitintool/view.php', array('id' => $this->contextinstanceid));
    }

    /**
     * Return the legacy event log data.
     *
     * @return array|null
     */
    protected function get_legacy_logdata() {
        $submission = $this->get_record_snapshot('turnitintool_submissions', $this->objectid);
        return array($this->courseid, 'turnitintool', 'submit', 'view.php?id=' . $this->contextinstanceid,
            "Upload to Turnitin failed for '{$submission->submission_title}'.", $this->contextinstanceid, $this->relateduserid);
    }

}
