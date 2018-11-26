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
	<h3 class="hndle" style="padding: 10px; margin: 0;"><span>Time & Date Translation</span></h3>
<div class="inside"><p align="justify">Display Time, Date and Numbers in Bangla language.
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Translate:</th>
        <td colspan="3">
        <input id="bntd_options[trans_dt]" type="checkbox" name="bntd_options[trans_dt]" value="1" <?php if(isset($bntd_options['trans_dt'])==1) echo('checked="checked"'); ?>/><label for="bntd_options[trans_dt]">All Time & Date</label>
		</td>
        </tr>
    </table>
</div></div>

<div class="postbox">
	<h3 class="hndle" style="padding: 10px; margin: 0;"><span>Time Zone Settings</span></h3>
<div class="inside"><p align="justify">Choose your Country time zone.</p>

    <table class="form-table">
        <tr valign="top">
            <th scope="row"><label for="greg_tz">Time Zone:</label></th>
            <td><select id="greg_tz" name="bntd_options[en_tz]">
            <option value="-12"<?php if($bntd_options['en_tz'] == "-12") { echo " selected"; } ?>>GMT -12</option>
            <option value="-11"<?php if($bntd_options['en_tz'] == "-11") { echo " selected"; } ?>>GMT -11</option>
            <option value="-10"<?php if($bntd_options['en_tz'] == "-10") { echo " selected"; } ?>>GMT -10</option>
            <option value="-9"<?php if($bntd_options['en_tz'] == "-9") { echo " selected"; } ?>>GMT -9</option>
            <option value="-8"<?php if($bntd_options['en_tz'] == "-8") { echo " selected"; } ?>>GMT -8</option>
            <option value="-7"<?php if($bntd_options['en_tz'] == "-7") { echo " selected"; } ?>>GMT -7</option>
            <option value="-6"<?php if($bntd_options['en_tz'] == "-6") { echo " selected"; } ?>>GMT -6</option>
            <option value="-5"<?php if($bntd_options['en_tz'] == "-5") { echo " selected"; } ?>>GMT -5</option>
            <option value="-4.5"<?php if($bntd_options['en_tz'] == "-4.5") { echo " selected"; } ?>>GMT -4:30</option>
            <option value="-4"<?php if($bntd_options['en_tz'] == "-4") { echo " selected"; } ?>>GMT -4</option>
            <option value="-3.5"<?php if($bntd_options['en_tz'] == "-3.5") { echo " selected"; } ?>>GMT -3:30</option>
            <option value="-3"<?php if($bntd_options['en_tz'] == "-3") { echo " selected"; } ?>>GMT -3</option>
            <option value="-2"<?php if($bntd_options['en_tz'] == "-2") { echo " selected"; } ?>>GMT -2</option>
            <option value="-1"<?php if($bntd_options['en_tz'] == "-1") { echo " selected"; } ?>>GMT -1</option>
            <option value="0"<?php if($bntd_options['en_tz'] == "0") { echo " selected"; } ?>>GMT 0</option>
            <option value="1"<?php if($bntd_options['en_tz'] == "1") { echo " selected"; } ?>>GMT +1</option>
            <option value="2"<?php if($bntd_options['en_tz'] == "2") { echo " selected"; } ?>>GMT +2</option>
            <option value="3"<?php if($bntd_options['en_tz'] == "3") { echo " selected"; } ?>>GMT +3</option>
            <option value="3.5"<?php if($bntd_options['en_tz'] == "3.5") { echo " selected"; } ?>>GMT +3:30</option>
            <option value="4"<?php if($bntd_options['en_tz'] == "4") { echo " selected"; } ?>>GMT +4</option>
            <option value="4.5"<?php if($bntd_options['en_tz'] == "4.5") { echo " selected"; } ?>>GMT +4:30</option>
            <option value="5"<?php if($bntd_options['en_tz'] == "5") { echo " selected"; } ?>>GMT +5</option>
            <option value="5.5"<?php if($bntd_options['en_tz'] == "5.5") { echo " selected"; } ?>>GMT +5:30</option>
            <option value="5.75"<?php if($bntd_options['en_tz'] == "5.75") { echo " selected"; } ?>>GMT +5:45</option>
            <option value="6"<?php if($bntd_options['en_tz'] == "6") { echo " selected"; } ?>>GMT +6</option>
            <option value="6.5"<?php if($bntd_options['en_tz'] == "6.5") { echo " selected"; } ?>>GMT +6:30</option>
            <option value="7"<?php if($bntd_options['en_tz'] == "7") { echo " selected"; } ?>>GMT +7</option>
            <option value="8"<?php if($bntd_options['en_tz'] == "8") { echo " selected"; } ?>>GMT +8</option>
            <option value="9"<?php if($bntd_options['en_tz'] == "9") { echo " selected"; } ?>>GMT +9</option>
            <option value="9.5"<?php if($bntd_options['en_tz'] == "9.5") { echo " selected"; } ?>>GMT +9:30</option>
            <option value="10"<?php if($bntd_options['en_tz'] == "10") { echo " selected"; } ?>>GMT +10</option>
            <option value="10.5"<?php if($bntd_options['en_tz'] == "10.5") { echo " selected"; } ?>>GMT +10:30</option>
            <option value="11"<?php if($bntd_options['en_tz'] == "11") { echo " selected"; } ?>>GMT +11</option>
            <option value="12"<?php if($bntd_options['en_tz'] == "12") { echo " selected"; } ?>>GMT +12</option>
            <option value="13"<?php if($bntd_options['en_tz'] == "13") { echo " selected"; } ?>>GMT +13</option>
            </select>
            </td>
        </tr>
    </table>
</div></div>

<div class="postbox">
	<h3 class="hndle" style="padding: 10px; margin: 0;"><span>Bangla Time Zone Settings</span></h3>
<div class="inside"><p align="justify">Select Bangladesh / India Time Zone</p>

    <table class="form-table">
        <tr valign="top">
        <th scope="row"><label for="bn_tz">Time Zone:</label></th>
        <td>
        <select id="bn_tz" name="bntd_options[bangla_tz]">
        <option value="5.5"<?php if($bntd_options['bangla_tz'] == "5.5") { echo " selected"; } ?>>GMT +5:30 (India)</option>
        <option value="6"<?php if($bntd_options['bangla_tz'] == "6") { echo " selected"; } ?>>GMT +6 (Bangladesh)</option>
        </select>
        </td>
        </tr>
    </table>
</div></div>

<div class="postbox">
	<h3 class="hndle" style="padding: 10px; margin: 0;"><span>Hijri Time Zone Settings</span></h3>
<div class="inside"><p align="justify">Hijri month can have 29 or 30 days depending on the moon. Adjust it manually. For example, 01 days = 24 hours.</p>

    <table class="form-table">
        <tr valign="top">
        <th scope="row"><label for="bntd_options[hijri_tz]">Time Zone:</label></th>
        <td>
		<select id="" name="" disabled="disabled">
		<option value="" selected="selected">Server Default</option>
		</select>
		</td>
        </tr>
        <tr valign="top">
        <th scope="row"><label for="bntd_options[hijri_adjust]">Plus or Minus Time (Hours):</label></th>
        <td><input maxlength="3" type="text" id="bntd_options[hijri_adjust]" name="bntd_options[hijri_adjust]" size="3" value="<?php echo $bntd_options['hijri_adjust']; ?>"> (Example: -12, +24 etc.)</td>
        </tr>
    </table>
</div></div>

<div class="postbox">
        <h3 class="hndle" style="padding: 10px; margin: 0;"><span>Widget Settings</span></h3>
    <div class="inside">
    
    <p>Here you can Enable or Disable Monthly Bangla Calendar widget. When enabled, additional scripts will be working Automatically.</p>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Calendar widgets:</th>
        <td><input type="checkbox" id="bntd_options[cal_wgt]" name="bntd_options[cal_wgt]" value="1" <?php if($bntd_options['cal_wgt']==1) echo('checked="checked"'); ?>/><label for="bntd_options[cal_wgt]">Enable</label></td>
        </tr>
	</table>
</div></div>

    <?php submit_button(); ?>
	</form>


	<form method="post" action="options.php">
	<?php settings_fields( 'bntd-settings-group' ); ?>
    
    <input type="hidden" name="restore_defaults" value="1">
    <input type="submit" value="Restore Default Settings" class="button button-secondary">
    </form>
    <br/>
    
<a name="credits"></a>
<div class="postbox">
	<h3 class="hndle" style="padding: 10px; margin: 0;"><span>Credits</span></h3>
	<div class="inside">
    <table class="form-table">
        <tr valign="top">
        <td>
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
