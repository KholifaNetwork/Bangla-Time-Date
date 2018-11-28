<?php
/*
Plugin Name: Bangla Time & Date
Plugin URI: http://kholifa.com/
Description: Displays Bangla Time & Date. Free & Simple Bangla Time & Date Plugins, Also get Bangla Calender.
Author: Faruk Hossain Surjo
Version: 1.0
Author URI: http://facebook.com/SurjoFans
*/

/*
This is free plugins, it modify under the GNU General Public License terms. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program; Address: Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA. Online: http://www.gnu.org/licenses/gpl.txt;
*/

// Bismillahir Rah Manir Rahim...


	defined( 'ABSPATH' ) or die( 'Stop! You can not do this!' );

  $bntd_options = get_option("bntd_options");
  if (!is_array($bntd_options)) {
    $bntd_options = array(
        'cal_wgt' => '0',
        'trans_dt' => '0',
        'trans_cmnt' => '0',
        'trans_num' => '0',
        'trans_cal' => '0' );
   }


	require 'translator.php';
	require 'class.banglaTimeDate.php';

	if (!class_exists('uCal')) {
			include_once('uCal.php');
		}

function bntd_bangla_time() {
	
	$bntd_options = get_option("bntd_options");
	if (!is_array($bntd_options)) {
		$bntd_options = array( 'en_tz' => '6' ); }

	$offset= $bntd_options['en_tz']*60*60; //converting hours to seconds.
	$hour = gmdate("G", time()+$offset);
	
	ob_start(); // begin output buffering
	
	if ($hour >= 5 && $hour <= 5) { $ddd = "সময়: ভোর "; }
	else if ($hour >= 6 && $hour <= 11) { $ddd = "সময়: সকাল "; }
	else if ($hour >= 12 && $hour <= 14) { $ddd = "সময়: দুপুর "; }
	else if ($hour >= 15 && $hour <= 17) { $ddd = "সময়: বিকাল "; }
	else if ($hour >= 18 && $hour <= 19) { $ddd = "সময়: সন্ধ্যা "; }
	else { $ddd = "সময়: রাত "; }
	
	printf ('%s', $ddd . ' ' . en_to_bn(gmdate("g:i", time()+$offset)) );
	
	$output = ob_get_contents(); // end output buffering
    ob_end_clean(); // grab the buffer contents and empty the buffer
    return $output;
	}


function bntd_bn_day() {
	$bntd_options = get_option("bntd_options");
	if (!is_array($bntd_options)) {
		$bntd_options = array( 'en_tz' => '6' ); }
		
	$str = en_to_bn(gmdate("l", time()+$bntd_options['en_tz']*60*60));
	return $str;
	}

function bntd_bangla_date() {

	$bntd_options = get_option("bntd_options");
	if (!is_array($bntd_options)) {
		$bntd_options = array( 'dt_change' => '0', 'separator' => ', ', 'last_word' => '1', 'ord_suffix' => '1' ); }
	if ( $bntd_options['last_word'] == "1" ) { $last_word = " বঙ্গাব্দ"; }

	$bn = new BanglaDate(time(), $bntd_options['dt_change']);
	$bdtday = $bn->get_day();
	$bdtmy = $bn->get_month_year();
	
	$day = sprintf( '%s', implode( ' ', $bdtday ) );
	$month_year = sprintf( '%s', implode( $bntd_options['separator'] , $bdtmy ) );
	
	$day_number = array( "১" => "১লা", "২" => "২রা", "৩" => "৩রা", "৪" => "৪ঠা", "৫" => "৫ই", "৬" => "৬ই", "৭" => "৭ই", "৮" => "৮ই", "৯" => "৯ই", "১০" => "১০ই", "১১" => "১১ই", "১২" => "১২ই", "১৩" => "১৩ই", "১৪" => "১৪ই", "১৫" => "১৫ই", "১৬" => "১৬ই", "১৭" => "১৭ই", "১৮" => "১৮ই", "১৯" => "১৯শে", "২০" => "২০শে", "২১" => "২১শে", "২২" => "২২শে", "২৩" => "২৩শে", "২৪" => "২৪শে", "২৫" => "২৫শে", "২৬" => "২৬শে", "২৭" => "২৭শে", "২৮" => "২৮শে", "২৯" => "২৯শে", "৩০" => "৩০শে", "৩১" => "৩১শে" );
	
	ob_start(); // begin output buffering
	
	if ( $bntd_options['ord_suffix'] == "1" ) { printf('%s', $day_number[$day] . ' ' . $month_year . $last_word); }
	else { printf ( $day . ' ' . $month_year . $last_word); }
	
	$output = ob_get_contents(); // end output buffering
    ob_end_clean(); // grab the buffer contents and empty the buffer
    return $output;
}


function bntd_bn_season() {
	$bntd_options = get_option("bntd_options");
	if (!is_array($bntd_options)) {
		$bntd_options = array( 'bangla_tz' => '6' ); }
	
	$bn = new BanglaDate(time()+$bntd_options['bangla_tz']*60*60, 0);
	$bdtmonth = $bn->get_month();
	$month = sprintf( '%s', implode( ' ', $bdtmonth ) );
	
	if($month == "বৈশাখ" || $month == "জ্যৈষ্ঠ") { return "এখন- গ্রীষ্মকাল"; }
	elseif($month == "আষাঢ়" || $month == "শ্রাবণ") { return "এখন- বর্ষাকাল"; }
	elseif($month == "ভাদ্র" || $month == "আশ্বিন") { return "এখন- শরৎকাল"; }
	elseif($month == "কার্তিক" || $month == "অগ্রহায়ণ") { return "এখন- হেমন্তকাল"; }
	elseif($month == "পৌষ" || $month == "মাঘ") { return "এখন- শীতকাল"; }
	else { return "এখন- বসন্তকাল"; }
}


function bntd_bn_en_date() {

    $bntd_options = get_option("bntd_options");
    if (!is_array($bntd_options)) {
		$bntd_options = array(
		'bangla_tz' => '6',
		'separator' => ', ',
		'last_word' => '1',
		'ord_suffix' => '1' );
		}
		
	if ( $bntd_options['last_word'] == "1" ) { $last_word = " ইং"; }
	
	if ( $bntd_options['ord_suffix'] == "1" ) { $day_number = array( "1" => "১লা", "2" => "২রা", "3" => "৩রা", "4" => "৪ঠা", "5" => "৫ই", "6" => "৬ই", "7" => "৭ই", "8" => "৮ই", "9" => "৯ই", "10" => "১০ই", "11" => "১১ই", "12" => "১২ই", "13" => "১৩ই", "14" => "১৪ই", "15" => "১৫ই", "16" => "১৬ই", "17" => "১৭ই", "18" => "১৮ই", "19" => "১৯শে", "20" => "২০শে", "21" => "২১শে", "22" => "২২শে", "23" => "২৩শে", "24" => "২৪শে", "25" => "২৫শে", "26" => "২৬শে", "27" => "২৭শে", "28" => "২৮শে", "29" => "২৯শে", "30" => "৩০শে", "31" => "৩১শে" ); }
	
	elseif ( $bntd_options['ord_suffix'] == "" ) { $day_number = array( "1" => "১", "2" => "২", "3" => "৩", "4" => "৪", "5" => "৫", "6" => "৬", "7" => "৭", "8" => "৮", "9" => "৯", "10" => "১০", "11" => "১১", "12" => "১২", "13" => "১৩", "14" => "১৪", "15" => "১৫", "16" => "১৬", "17" => "১৭", "18" => "১৮", "19" => "১৯", "20" => "২০", "21" => "২১", "22" => "২২", "23" => "২৩", "24" => "২৪", "25" => "২৫", "26" => "২৬", "27" => "২৭", "28" => "২৮", "29" => "২৯", "30" => "৩০", "31" => "৩১" ); }
	
	ob_start(); // begin output buffering
	
	$offset = $bntd_options['en_tz']*60*60;
	
	printf ('%s', $day_number[gmdate("j", time()+$offset)] . " " . en_to_bn(gmdate("F", time()+$offset)) . $bntd_options['separator'] . en_to_bn(gmdate("Y", time()+$offset)) . $last_word);
	$output = ob_get_contents(); // end output buffering
    ob_end_clean(); // grab the buffer contents and empty the buffer
    return $output;
}

function bntd_bn_hijri_date() {

    $bntd_options = get_option("bntd_options");
    if (!is_array($bntd_options)) {
		$bntd_options = array(
		'hijri_adjust' => '-0',
		'separator' => ', ',
		'last_word' => '1',
		'ord_suffix' => '1' );
		}
		
	if ( $bntd_options['last_word'] == "1" ) { $last_word = " হিজরী"; }
	
	$offset = $bntd_options['hijri_adjust'] * 60 * 60;
	
	$d = new uCal;
	
	if ( $bntd_options['ord_suffix'] == "1" ) { $day_number = array( "1" => "১লা", "2" => "২রা", "3" => "৩রা", "4" => "৪ঠা", "5" => "৫ই", "6" => "৬ই", "7" => "৭ই", "8" => "৮ই", "9" => "৯ই", "10" => "১০ই", "11" => "১১ই", "12" => "১২ই", "13" => "১৩ই", "14" => "১৪ই", "15" => "১৫ই", "16" => "১৬ই", "17" => "১৭ই", "18" => "১৮ই", "19" => "১৯শে", "20" => "২০শে", "21" => "২১শে", "22" => "২২শে", "23" => "২৩শে", "24" => "২৪শে", "25" => "২৫শে", "26" => "২৬শে", "27" => "২৭শে", "28" => "২৮শে", "29" => "২৯শে", "30" => "৩০শে", "31" => "৩১শে" ); }
	
	elseif ( $bntd_options['ord_suffix'] == "" ) { $day_number = array( "1" => "১", "2" => "২", "3" => "৩", "4" => "৪", "5" => "৫", "6" => "৬", "7" => "৭", "8" => "৮", "9" => "৯", "10" => "১০", "11" => "১১", "12" => "১২", "13" => "১৩", "14" => "১৪", "15" => "১৫", "16" => "১৬", "17" => "১৭", "18" => "১৮", "19" => "১৯", "20" => "২০", "21" => "২১", "22" => "২২", "23" => "২৩", "24" => "২৪", "25" => "২৫", "26" => "২৬", "27" => "২৭", "28" => "২৮", "29" => "২৯", "30" => "৩০", "31" => "৩১" ); }
	
	$month_name = array( "Muh" => "মুহাররম", "Saf" => "সফর", "Rb1" => "রবিউল-আউয়াল", "Rb2" => "রবিউস-সানি", "Jm1" => "জমাদিউল-আউয়াল", "Jm2" => "জমাদিউস-সানি", "Raj" => "রজব", "Shb" => "শাবান", "Rmd" => "রমযান", "Shw" => "শাওয়াল", "DhQ" => "জিলক্বদ", "DhH" => "জিলহজ্জ" );
	ob_start(); // begin output buffering
	
	printf('%s', $day_number[$d->date("j", time()+$offset)] . " " . $month_name[$d->date("M", time()+$offset)] . $bntd_options['separator'] . en_to_bn($d->date("Y", time()+$offset)) . $last_word);
	
	$output = ob_get_contents(); // end output buffering
    ob_end_clean(); // grab the buffer contents and empty the buffer
    return $output;
}


function bntd_header_content() {
?>
	<script type="text/javascript" src="<?php echo WP_PLUGIN_URL; ?>/bangla-time-date/bncalendar.inc.js"></script>
    <style type="text/css">
    <?php include "style.inc.css"; ?>
    </style>
<?php }

function bntd_bn_calendar() {
?>
	<script type="text/javascript">
    document.write(BanglaMas());
    </script>
<?php
}


function bntd_en_bn_calendar() {
?>
	<script type="text/javascript">
    
    var todaydate=new Date();
    todaydate.setTime(todaydate.getTime() +(todaydate.getTimezoneOffset()+360)*60*1000); 
    var curmonth=todaydate.getMonth()+1; //get current month (1-12)
    var curyear=todaydate.getFullYear(); //get current year
    
    document.write(buildCal(curmonth ,curyear, "bc_main", "bc_month", "bc_daysofweek", "bc_days", 1));
    </script>
<?php
}

//================== Widget 01 ========================

function widget_bangla_time_date($args) {
	extract($args);
	
	  	$bntd_wgt1 = get_option("bntd_wgt1");
	if (!is_array($bntd_wgt1)) {
	$bntd_wgt1 = array(
		'title' => 'আজকের দিন ও তারিখ',
        'day' => '1',
        'time' => '1',
        'en_date' => '1',
        'hijri_date' => '1',
        'bn_date' => '1',
        'season' => '1' );
	}

	echo $before_widget;
	echo $before_title . $bntd_wgt1['title'] . $after_title;
	echo "<ul>";
	if ($bntd_wgt1['day'] == "1" || $bntd_wgt1['time'] == "1") { echo "<li>"; }
	if ($bntd_wgt1['day'] == "1") { echo do_shortcode('[bangla_day]'); }
	if ($bntd_wgt1['time'] == "1") { echo " ("; echo do_shortcode('[bangla_time]'); echo ")"; }
	if ($bntd_wgt1['day'] == "1" || $bntd_wgt1['show_time'] == "1") { echo "</li>"; }
	if ($bntd_wgt1['en_date'] == "1") { echo "<li>"; echo do_shortcode('[english_date]'); echo "</li>"; }
	if ($bntd_wgt1['hijri_date'] == "1") { echo "<li>"; echo do_shortcode('[hijri_date]'); echo "</li>"; }
	if ($bntd_wgt1['bn_date'] == "1" || $bntd_wgt1['show_season'] == "1") { echo "<li>"; }
	if ($bntd_wgt1['bn_date'] == "1") { echo do_shortcode('[bangla_date]'); }
	if ($bntd_wgt1['season'] == "1") { echo " ("; echo do_shortcode('[bangla_season]'); echo ")"; } ?><?php if ($bntd_wgt1['bn_date'] == "1" || $bntd_wgt1['season'] == "1") { echo "</li>"; }
	echo "</ul>";
	echo $after_widget;
}

function bntd_wgt1_control() {
	$bntd_wgt1 = get_option("bntd_wgt1");
	if (!is_array($bntd_wgt1)) {
// add query arguments: action, post, nonce
	$bntd_wgt1 = array(
		'title' => 'আজকের দিন ও তারিখ',
        'day' => '1',
        'time' => '1',
        'en_date' => '1',
        'hijri_date' => '1',
        'bn_date' => '1',
        'season' => '1' );
	}
  
	if($_POST['widget_control_submit'])
	{
	  $bntd_wgt1['title']=($_POST['title']);
	  $bntd_wgt1['day']=($_POST['day']);
	  $bntd_wgt1['time']=($_POST['time']);
	  $bntd_wgt1['en_date']=($_POST ['en_date']);
	  $bntd_wgt1['hijri_date']=($_POST ['hijri_date']);
	  $bntd_wgt1['bn_date']=($_POST ['bn_date']);
	  $bntd_wgt1['season']=($_POST ['season']);
	  update_option ("bntd_wgt1", $bntd_wgt1);
	}
?>

	<p>
	<table width="100%">
	<tr><td> <label for="title">Title: </label></td>
    <td><input type="text" id="title" name="title" value="<?php echo $bntd_wgt1['title'];?>"/> </td></tr>

	<tr><td>Show:</td>
    <td><input type="checkbox" id="day" name="day" value="1" <?php if($bntd_wgt1['day']==1) echo('checked="checked"'); ?>/><label for="day">Day</label></td></tr>

	<tr><td></td>
    <td><input type="checkbox" id="time" name="time" value="1" <?php if($bntd_wgt1['time']==1) echo('checked="checked"'); ?>/><label for="time">Time</label></td></tr>

	<tr><td></td>
    <td><input type="checkbox" id="en_date" name="en_date" value="1" <?php if($bntd_wgt1['en_date']==1) echo('checked="checked"'); ?>/><label for="en_date">Gregorian Date</label></td></tr>

	<tr><td></td>
    <td><input type="checkbox" id="hijri_date" name="hijri_date" value="1" <?php if($bntd_wgt1['hijri_date']==1) echo('checked="checked"'); ?>/><label for="hijri_date">Hijri Date</label></td></tr>

	<tr><td></td>
    <td><input type="checkbox" id="bn_date" name="bn_date" value="1" <?php if($bntd_wgt1['bn_date']==1) echo('checked="checked"'); ?>/><label for="bn_date">Bangla Date</label></td></tr>

	<tr><td></td>
    <td><input type="checkbox" id="season" name="season" value="1" <?php if($bntd_wgt1['season']==1) echo('checked="checked"'); ?>/><label for="season">Season Name</label></td></tr>
	</table>

    <input type="hidden" id="widget_control_submit"  name="widget_control_submit" value="1" />
  </p>
<?php
}

 
// ========== Action Links =================
 
function bntd_action_links($links) {
	$links[] = '<a href="' . get_admin_url(null, 'options-general.php?page=bangla-time-date') . '">Settings</a>';
	return $links;
}

	add_filter('plugin_action_links_' . plugin_basename(_FILE_), 'bntd_action_links');

//====================================

if ($bntd_options['cal_wgt'] == "1") { add_action('wp_head', 'bntd_header_content'); }

wp_register_sidebar_widget('bangla_time_date', 'Bangla Time & Date', 'widget_bangla_time_date', array('description' => _('Display Bangla Time & Date, Gregorian, Hijri & Bangla season name.')));
wp_register_widget_control('bangla_time_date', 'Bangla Time & Date', 'bntd_wgt1_control');


	add_shortcode('bangla_time', 'bntd_bangla_time');
	add_shortcode('bangla_day', 'bntd_bn_day');
	add_shortcode('bangla_date', 'bntd_bangla_date');
	add_shortcode('bangla_season', 'bntd_bn_season');
	add_shortcode('english_date', 'bntd_bn_en_date');
	add_shortcode('hijri_date', 'bntd_bn_hijri_date');
	add_shortcode('bn_calendar', 'bntd_bn_calendar');
	add_shortcode('en_bn_calendar', 'bntd_en_bn_calendar');

    if(is_admin())
    include 'bntd_admin.php';

?>
