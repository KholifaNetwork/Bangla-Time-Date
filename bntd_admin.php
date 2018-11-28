<?php

	defined( 'ABSPATH' ) or die( 'Stop! You can not do this!' );
	
function bntd_options_page() {
	?>
    <div class="wrap">
    <h1 style="margin-bottom:5px;">Bangla Time & Date Settings <a target="_blank" href="https://kholifa.com" class="button button-secondary">Kholifa.Com</a> | <a target="_blank" href="https://kholifa.net" class="button button-secondary">Kholifa.Net</a></h1>
    <br/>

<?php if(isset($_POST["restore_defaults"]) == "1") { delete_option('bntd_options'); } ?>
    
    <form method="post" action="options.php">
    
    <?php
function rplc_symbol($symbol) {
	$symbol = str_replace('"', '&#34;', $symbol);
	return $symbol;
	}

settings_fields( 'bntd-settings-group' );

	$bntd_options = get_option("bntd_options");
	if (!is_array($bntd_options)) {
	$bntd_options = array(
		'trans_dt' => '0',
		'bangla_tz' => '6',
		'en_tz' => '6',
        'trans_cmnt' => '0',
        'trans_num' => '0',
        'trans_cal' => '0',
        'dt_change' => '0',
        'ord_suffix' => '1',
        'separator' => ', ',
        'last_word' => '1',
        'hijri_adjust' => '-24',
        'cal_wgt' => '0' );
	}

?>

<div class="postbox">
	<h3 class="hndle" style="padding: 10px; margin: 0;"><span>Time Zone Settings</span></h3>
<div class="inside"><p align="justify"><b>No needed extra settings cz this plugins only for bangladeshi peoples, all options including on widget area.</b>

<br><br><br>
<b>Thanks for Using Bangla Time & Date Plugins, if you like this please support us via visiting our website and like our facebook page.</b>
<br>
<br>
<br><br>
Best Regards...<br>
<b>Kholifa Network</b></p>

</div></div>

<br><br>
    
    <br/>
    
<a name="credits"></a>
<div class="postbox">
	<h3 class="hndle" style="padding: 10px; margin: 0;"><span>Credits</span></h3>
	<div class="inside">
    <table class="form-table">
        <tr valign="top">
        <td>
<p><a href="http://facebook.com/SurjoFans" target="_blank"><img src="http://www.gravatar.com/avatar/<?php echo md5( "rj.surjo@gmail.com" ); ?>" /></a></p>
    <p>Developer: <a href="http://facebook.com/SurjoFans" target="_blank">Faruk Hossain Surjo</a><br />
    E-Mail: mail.surjo@gmail.com<br />
    Website: <a href="http://surjo.net" target="_blank">Surjo.Net</a><br/>
    <p align="justify">This is free plugins, it modify under the GNU General Public License terms. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program. See <a href="http://www.gnu.org/licenses/gpl.txt" target="_blank">GNU General Public License</a> for more Info.</p><br/>
    <p align="justify">A project of <a href="http://kholifa.com" target="_blank">Kholifa Network</a></p>
    </td>
    <td>
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=330291150372591&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<div class="fb-like-box" data-href="https://www.facebook.com/KholifaNetwork" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
    </td>
    <td>
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=330291150372591&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<div class="fb-like-box" data-href="https://www.facebook.com/SurjoFans" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
    </td>
    </tr>
    </table>
    </div></div>

</div>

<?php
	}


//Contextual Help Menu --------------------------------------
function bntd_help($contextual_help, $screen_id, $screen) {

	global $bntd_hook;
	if ($screen_id == $bntd_hook) {

		$contextual_help = 'For any help, contact <a href="http://facebook.com/SurjoFans" target="_blank">Faruk Hossain Surjo</a>.<br/>E-Mail: mail.surjo@gmail.com<br/>Web: <a href="http://kholifa.net" target="_blank">Kholifa.Net</a><br/>View: <a href="http://wordpress.org/support/plugin/bangla-time-date" target="_blank">Support Forum</a> | <a href="http://wordpress.org/plugins/bangla-time-date/changelog/" target="_blank">Changelog</a><br/>Wordpress Plugins Directory: <a href="http://wordpress.org/plugins/bangla-time-date" target="_blank">http://wordpress.org/plugins/bangla-time-date</a><br/><span style="color: red;">Keep your plugin up to date.</span>';
	}
	return $contextual_help;
}


function bntd_admin() {
	
	global $bntd_hook;
	$bntd_hook = add_options_page('Bangla Time & Date Settings', 'Bangla Time & Date', 'activate_plugins', 'bangla-time-date', 'bntd_options_page');
}

// Register settings --------------------------------
	
function register_bntd_settings() {
	register_setting( 'bntd-settings-group', 'bntd_options' );
}


	add_action('admin_menu', 'bntd_admin');
	add_action('admin_init', 'register_bntd_settings');
	add_filter('contextual_help', 'bntd_help', 10, 3);

?>
