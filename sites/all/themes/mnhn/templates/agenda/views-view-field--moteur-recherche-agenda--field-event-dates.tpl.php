<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
 //dpm($row->field_field_event_dates);
?>

<?php
$culture='fr_FR'; 
setlocale(LC_TIME, $culture.'.utf8', $culture.'.UTF8', $culture.'.utf-8', $culture.'.UTF-8');
$date_debut_timestamp = strtotime($row->field_field_event_dates[0]['raw']['value']);
$date_fin_timestamp = strtotime($row->field_field_event_dates[0]['raw']['value2']);

$date_debut = strftime("%d %B %Y", $date_debut_timestamp);
$date_fin = strftime("%d %B %Y", $date_fin_timestamp);

print '<div class="views-field-field-event-dates">';
    if($date_debut == $date_fin){
        print $date_debut;
    }else{
        print 'du '.$date_debut.' au '.$date_fin;
    }
print '</div>';
?>