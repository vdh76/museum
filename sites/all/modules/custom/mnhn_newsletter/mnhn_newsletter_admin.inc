<?php 


/*
 * BO Newsletter
 * Export inscription
 * 
 * 
 */
function mnhn_newsletter_export_subscription(){
	
   
 
	header("Content-type: text/csv; charset=UTF-8");
	header("Content-Disposition: attachment; filename=museum_export_inscription_newsletter.csv");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	
	$output='EMAIL;DATE;'."\n";
	
	$sql = 'SELECT mail,date from mnhn_newsletter order by date desc';
	$result=db_query($sql);
	
	
	
	foreach($result as $row){
		$output.=$row->mail.';'.date('d/m/Y',$row->date)."\n";			
	}
	
		
	print utf8_decode($output);
	

}


?>