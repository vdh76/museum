<?php
/**
 * @file 
 * Template to display the date box in a calendar.
 *
 * - $view: The view.
 * - $granularity: The type of calendar this box is in -- year, month, day, or week.
 * - $mini: Whether or not this is a mini calendar.
 * - $class: The class for this box -- mini-on, mini-off, or day.
 * - $day:  The day of the month.
 * - $date: The current date, in the form YYYY-MM-DD.
 * - $link: A formatted link to the calendar day view for this day.
 * - $url:  The url to the calendar day view for this day.
 * - $selected: Whether or not this day has any items.
 * - $items: An array of items for this day.
 */
?>


 <?php
  if (!empty($selected)) {
    
    $infos_event = '';
        foreach ($items[$date]['00:00:00'] as $key => $value) {
            $type_event = taxonomy_term_load($value->entity->field_event_type['und'][0]['tid'])->name;
            $title_event = $value->title;
            //$date_start_event = date('d-m-Y',strtotime($value->date_start->originalTime));
            //$date_end_event = date('d-m-Y',strtotime($value->date_end->originalTime));
            
            $infos_event .= '<li>';
            $infos_event .= $type_event.' - ';                                //type evenement
            $infos_event .= '<strong>'.l($title_event,drupal_get_path_alias('node/'.$value->entity->nid)).'</strong><br/>';   //titre
            
            /*
            if($date_start_event != $date_end_event){
                $infos_event .= 'Du '.$date_start_event.' au '.$date_end_event;
            }else{
                $infos_event .= 'Le '.$date_start_event;
            }
            */
            
            $infos_event .= '</li>';
        }
        
        $enter_date = strtotime($items[$date]['00:00:00'][0]->calendar_start);
        $out_date = date('d/m/Y', $enter_date);
        $year = date('Y', $enter_date);
        $mini_calendar_date = date('Y-m', $enter_date);
        $get_out_date = array("debut[value][date]" => $out_date, "fin[value][date]" => $out_date, "mini" => $mini_calendar_date);
    
    if(@$items[$date]['00:00:00'][1]){
        
                
        $link = l($day, "agenda", array('query' => $get_out_date) );
        
        
    }else{
        $items = reset($items[$date]);
        // Only get the first item.
        $entity = $items[0];
        $link = l($day, 'node/' . $entity->id, array('query' => array("mini" => $mini_calendar_date)));
    }
     
  }
  
?>

<div class="<?php print $granularity ?> <?php print $class; ?> link_info"> <?php print !empty($selected) ? $link : $day; ?> </div>
<div class="info_bulle" style="display: none;"><ul><?php print @$infos_event ?></ul></div>


