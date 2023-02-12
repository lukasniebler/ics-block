<?php

namespace RRZE\IcsBlock;

defined('ABSPATH') || exit;

class RestApi
{
    public function __construct()
    {
        add_action('rest_api_init', [$this, 'restApiInit']);
    }

    public function restApiInit()
    {
        register_rest_route('icsProcessor/v1', '/events', array(
            'methods' => \WP_REST_Server::READABLE,
            'callback' => [$this, 'passToRest'],
        ));

    }

    public function passToRest()
    {
        $plugins_url = plugins_url();
        $ics_file_url = $plugins_url . '/ics-block/test.ics';
        error_log("Remember to remove L27 in RestAPI. Test ICS file url: " . $ics_file_url);
        $IcsP = new IcsProcessor($ics_file_url);

        //$IcsP = new IcsProcessor('../test.ics');
        $icsData = $IcsP->getIcsData();

        return rest_ensure_response($icsData);
    }
}
