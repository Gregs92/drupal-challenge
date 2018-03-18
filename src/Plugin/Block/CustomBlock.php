<?php

namespace Drupal\challenge\Plugin\Block;

use Drupal\Core\Block\BlockBase;

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
        $dateHelper = \Drupal::service('challenge.date_helper');

        $node = \Drupal::routeMatch()->getParameter('node');
        $event_timestamp = strtotime($node->get('field_event_date')->value);

        $out = $dateHelper->remainingDays($event_timestamp);

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