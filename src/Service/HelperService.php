<?php
/**
 * @file providing the service that returns string based on input date of event.
 *
 */
namespace  Drupal\challenge\Service;

use \Datetime;

class HelperService {

    public function __construct() {
    }

    public function remainingDays($date){
        $event_date = new DateTime();
        $event_date->setTimeStamp($date);
        $now = new DateTime();

        if ($event_date->format('d-m-Y') == $now->format('d-m-Y')) {
            return 'The event is in progress.';
        }
        else if ($event_date > $now) {
            $diff = $event_date->diff($now);
            return 'Days left to event start: '. $diff->days;
        }
        else if ($event_date < $now) {
            return 'The Event has ended.';
        }
    }
}