<?php
require_once 'getReservedSlots.php';

function getAvailableSlots() {
    $slots = [];
    $startHour = 10;
    $endHour = 17;
    
    $date = new DateTime();
    $date->setTime(0, 0, 0);
    
    $reservedSlots = getReservedSlots();
    
    for ($d = 0; $d < 7; $d++) {
        for ($h = $startHour; $h <= $endHour; $h++) {
            $slotDate = clone $date;
            $slotDate->setTime($h, 0, 0);
            $slotString = $slotDate->format('Y-m-d H:i:s');
        
            if ($slotDate > new DateTime() && !in_array($slotString, $reservedSlots)) {
                $slots[] = $slotString;
            }
        }
        $date->modify('+1 day');
    }
    
    return $slots;
}
