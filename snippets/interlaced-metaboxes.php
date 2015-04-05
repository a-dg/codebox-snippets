public function getMetaBoxes() {
 $sponsorship_levels = array_keys(self::getSponsorshipLevels());
 $interlaced_sponsorship_levels = array();
 if(Arr::iterable($sponsorship_levels)) {
   foreach($sponsorship_levels as $key => $sponsorship_level) {
     $interlaced_sponsorship_levels[$key * 2] = $sponsorship_level;
     if($key == count($sponsorship_levels) - 1) continue;
     $interlaced_sponsorship_levels[($key * 2) + 1] = '<hr>';
   }
 }

 return array(
   'event' => array(
     'is_special',
     'event_date_start',
     'event_date_end',
     'event_time_start',
     'event_time_end',
     'is_open_registration',
     'registration_url',
     'image_path',
     'itinerary',
   ),
   'sponsors' => array_values($interlaced_sponsorship_levels),
 );
}