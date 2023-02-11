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
        $IcsP = new IcsProcessor('http://groupware.fau.de/owa/calendar/RRZE_RS_Events@exch.fau.de/Kalender/calendar.ics');
        $icsData = $IcsP->getIcsData();

        return rest_ensure_response($icsData);
    }
}
