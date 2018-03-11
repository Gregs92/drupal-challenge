<?php

namespace Drupal\challenge\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use \Datetime;

/**
 * Provides a 'Remaining Days' Block.
 *
 * @Block(
 *   id = "remaining_days_block",
 *   admin_label = @Translation("Remaining Days"),
 *   category = @Translation("Challenge"),
 * )
 */
class CustomBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {
        $node = \Drupal::routeMatch()->getParameter('node');
        $event_timestamp = strtotime($node->get('field_event_date')->value);
        $event_date = new DateTime();
        $event_date->setTimeStamp($event_timestamp);
        $now = new DateTime();

        if ($event_date->format('d-m-Y') == $now->format('d-m-Y')) {
            $out = 'The event is in progress.';
        }
        else if ($event_date > $now) {
            $diff = $event_date->diff($now);
            $out = 'Days left to event start: '. $diff->days;
        }
        else if ($event_date < $now) {
            $out = 'The Event has ended.';
        }

        $build = [];
        $build['event_days_block_extra_text']['#markup'] = $out;
        return $build;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheMaxAge() {
        return 0;
    }

}