<?php
/**
 * Plugin Name:       ICS Block
 * Plugin URI:        www.rrze.de
 * Description:       A Block to output ics feeds
 * Version:           0.1.0
 * Requires at least: 6.1
 * Requires PHP:      8.0
 * Author:            Lukas Niebler
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ics-block
 *
 * @package           rrze
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function rrze_ics_block_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'rrze_ics_block_block_init' );
