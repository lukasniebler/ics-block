<?php

namespace RRZE\IcsBlock;

defined('ABSPATH') || exit;

class Main
{
    public function __construct()
    {
        new Helper();
        $this->register_ics_block_shortcode();
        new RestApi();
    }

    //create a shortcode named ics_block
    public function ics_block_shortcode($atts)
    {
        $IcsP = new IcsProcessor($atts['url'] ?? '');
        $icsData = $IcsP->getIcsData();
        if (is_array($icsData)) {
            error_log(print_r($icsData, true));
        } else {
            error_log('The data is not an array.');
        }

        return "HI";
    }

    //register the shortcode
    public function register_ics_block_shortcode()
    {
        add_shortcode('ics_block', [$this, 'ics_block_shortcode']);
    }
}
