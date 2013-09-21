<?php 
function time_ago($unix_date) {
 
	if(empty($unix_date)) {
		return FALSE;
	}
 
	$periods = array("秒", "分", "小时", "天", "周", "月", "年", "十年");
 
	$lengths = array("60","60","24","7","4.35","12","10");
 
	$now = time();
 
	// is it future date or past date
 
	if($now > $unix_date) {
		$difference = $now - $unix_date;
		$tense = "之前";
	} else {
		$difference = $unix_date - $now;
		$tense = "之后";
	}
 
	for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		$difference /= $lengths[$j];
	}
 
	$difference = round($difference);
	 
	// if($difference != 1) {
		// $periods[$j].= "s";
	// }
 
	return $difference.$periods[$j].$tense;
}