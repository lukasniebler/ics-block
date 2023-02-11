<?php

namespace RRZE\IcsBlock;

use ICal\ICal;

defined('ABSPATH') || exit;

class IcsProcessor
{
    private $ics_url;
    private $cleanedData;

    public function __construct($ics_url)
    {
        $this->setIcsUrl($ics_url);
        $this->getIcsData();
    }

    //getter
    public function getIcsUrl()
    {
        return $this->ics_url;
    }

    //setter
    public function setIcsUrl($ics_url)
    {
        //check if set
        if (empty($ics_url)) {
            return;
        } else {
            $this->ics_url = $ics_url;
        }
    }

    public function getIcsData()
    {
        // Hier gibst du die URL des ICS-Feeds an
        //check if empty
        if (empty($this->getIcsUrl())) {
            return;
        } else {
            $ics_data = file_get_contents($this->ics_url);

            $ical = new ICal($ics_data);
            $events = $ical->events();

            return $this->icsPrettier($events);
        }
    }

    public function getCleanedData()
    {
        return $this->cleanedData;
    }

    public function setCleanedData($ics_data)
    {
        $this->cleanedData = $ics_data;
    }

    public function icsPrettier($originalArray)
    {
        $newArray = [];
        foreach ($originalArray as $event) {
            $newEvent = [
                'summary' => $event->summary,
                'dtstart' => $event->dtstart,
                'dtend' => $event->dtend,
                'location' => $event->location,
                'description' => $event->description,
            ];
            $newArray[] = $newEvent;
        }
        $this->setCleanedData($newArray);
        return $newArray;
    }

}
