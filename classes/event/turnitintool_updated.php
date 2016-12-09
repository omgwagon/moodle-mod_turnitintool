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
 * The mod_turnitintool turnitintool updated event.
 *
 * @package    mod_turnitintool
 * @copyright  2014 NetSpot Pty Ltd
 * @author     Adam Olley <adam.olley@netspot.com.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_turnitintool\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The mod_turnitintool turnitintool updated event class.
 *
 * @property-read array $other {
 *      turnitintoolname
 * }
 *
 * @package    mod_turnitintool
 * @since      Moodle 2.7
 * @copyright  2014 NetSpot Pty Ltd
 * @author     Adam Olley <adam.olley@netspot.com.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class turnitintool_updated extends \core\event\base {

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
        $this->data['objecttable'] = 'turnitintool';
    }

    public function get_description() {
        return "The user with id '$this->userid' has updated the turnitintool with id '$this->objectid'.";
    }

    public static function get_name() {
        return get_string('eventturnitintoolupdated', 'mod_turnitintool');
    }

    /**
     * Get URL related to the action.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/mod/turnitintool/view.php', array('id' => $this->contextinstanceid));
    }


    protected function get_legacy_logdata() {
        return array($this->courseid, 'turnitintool', 'update turnitintool', 'view.php?id=' . $this->contextinstanceid,
            "Assignment updated '{$this->other['turnitintoolname']}'", $this->contextinstanceid);
    }

}
