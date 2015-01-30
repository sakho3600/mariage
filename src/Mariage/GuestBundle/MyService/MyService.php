<?php

namespace Mariage\GuestBundle\MyService;

class MyService
{
    public function getTimeLeft()
    {
        $dDay = new \DateTime("2015/06/13");
        $diff = $dDay->diff(new \DateTime() );

        return $diff->format('%a');
    }
}
