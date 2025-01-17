<?php 
/**
 * Holds all advanced tools functionality
*/

add_action("wplc_hook_menu", "wplc_at_add_menu");
/**
 * Add the menu item to the WP Live Chat Support Menu
*/
function wplc_at_add_menu(){
    add_submenu_page('wplivechat-menu', __('Tools', 'wplivechat'), __('Tools', 'wplivechat'), 'manage_options', 'wplivechat-menu-at', 'wplc_at_page_layout');
}

/**
 * Render the Advanced Settings Page
*/
function wplc_at_page_layout(){
	?>
	<h2><?php _e("WP Live Chat Support - Tools","wplivechat"); ?></h2>

	<?php
	if(isset($_GET['wplc_at_action']) && $_GET['wplc_at_action'] == 'import_prompt'){
		wplc_at_import_prompt();
	}
	?>


	<table class='wp-list-table widefat fixed striped pages'>
		<tr>
			<td>
				<strong style="font-size:16px"><?php _e("Chat Data", "wplivechat"); ?></strong>
			</td>
			<td>
			</td>
		</tr>

		<tr>
			<td>
				<?php _e("Chat Settings", "wplivechat"); ?>:
			</td>
			<td>
				<a href="?page=wplivechat-menu-at&wplc_at_action=export_settings" class='button-secondary' target="_blank">
					<?php _e("Export Settings", "wplivechat"); ?>
				</a> 
				<a href="?page=wplivechat-menu-at&wplc_at_action=import_prompt" class='button-primary'>
					<?php _e("Import Settings", "wplivechat"); ?>
				</a>
			</td>
		</tr>

		<tr>
			<td>
				<?php _e("Chat History", "wplivechat"); ?>:
			</td>
			<td>
				<a href="?page=wplivechat-menu-at&wplc_at_action=export_history" class='button-secondary' target="_blank">
					<?php _e("Export History", "wplivechat"); ?>
				</a>
			</td>
		</tr>

		<tr>
			<td>
				<?php _e("Chat Ratings", "wplivechat"); ?>:
			</td>
			<td>
				<a href="?page=wplivechat-menu-at&wplc_at_action=export_ratings" class='button-secondary' target="_blank">
					<?php _e("Export Ratings", "wplivechat"); ?>
				</a>
			</td>
		</tr>

		<tr>
			<td>
				<?php _e("Offline Messages", "wplivechat"); ?>:
			</td>
			<td>
				<a href="?page=wplivechat-menu-at&wplc_at_action=export_offline_msg" class='button-secondary' target="_blank">
					<?php _e("Export Offline Messages", "wplivechat"); ?>
				</a>
			</td>
		</tr>
	</table>

	<?php
}

/**
 * Import Prompt Rendered
*/
function wplc_at_import_prompt(){
	if(!isset($_FILES['wplc_at_import_file']) || $_FILES['wplc_at_import_file']['name'] === ""){
	?>
		<table class='wp-list-table widefat fixed striped pages'>
			<form method="POST" enctype="multipart/form-data">
			<tr>
				<td>
					<strong style="font-size:16px"><?php _e("Import Settings", "wplivechat"); ?></strong>
				</td>
				<td>
				</td>
			</tr>

			<tr>
				<td>
					<?php _e("CSV File", "wplivechat"); ?>:
				</td>
				<td>
					<input type="file" name="wplc_at_import_file" id="wplc_at_import_file" />
				</td>
			</tr>

			<tr>
				<td>
				</td>
				<td>
					<em><?php _e("Please note: Import CSV must have been exported using the Export tool", "wplivechat"); ?></em>
				</td>
			</tr>

			<tr>
				<td>
				</td>
				<td>
					<input class="button-primary" type="submit" name="wplc_at_file_import_submit" value="<?php _e("Import", "wplivechat"); ?>" /> <strong><em>(<?php _e("This cannot be undone", "wplivechat"); ?>)</em></strong>
				</td>
			</tr>

			</form>
		</table>
		<br />
	<?php
	} else {
		if(isset($_FILES['wplc_at_import_file']['tmp_name'])){
			$row = 1;
			$file_ref = $_FILES['wplc_at_import_file']['tmp_name'];
			$handle = fopen($file_ref, "r");
			if ($handle !== FALSE) {
			    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			        $num = count($data);
			        if($num == 2 && $row > 1){ //Must be 2 
				        $key = $data[0];
				        $value = maybe_unserialize($data[1]);

				        update_option($key, $value);
				    }
			        $row++;
			    }
			    fclose($handle);
			} else {
				//File could not be openend
				?>
					<table class='wp-list-table widefat fixed striped pages'>
						<tr>
							<td>
								<strong style="font-size:16px"><?php _e("Import Failed - Could Not Process File", "wplivechat"); ?></strong>
							</td>
							<td>
							</td>
						</tr>
					</table>
				<?php
			}
		} else {
			//File cannot be found
			?>
				<table class='wp-list-table widefat fixed striped pages'>
					<tr>
						<td>
							<strong style="font-size:16px"><?php _e("Import Failed - Could Not Find File", "wplivechat"); ?></strong>
						</td>
						<td>
						</td>
					</tr>
				</table>
			<?php
		}
		?>
		<table class='wp-list-table widefat fixed striped pages'>
			<tr>
				<td>
					<strong style="font-size:16px"><?php _e("Import Complete", "wplivechat"); ?></strong>
				</td>
				<td>
				</td>
			</tr>

			<tr>
				<td>
					<?php _e("Thank you, all settings have been updated", "wplivechat"); ?>
				</td>
				<td></td>
			</tr>
		</table>
		<br />
	<?php
	}
}

add_action("admin_init", "wplc_at_export_head");
/**
 * Check if the user is requesting any exports
*/
function wplc_at_export_head(){
	if(isset($_GET['wplc_at_action']) && $_GET['wplc_at_action'] == 'export_settings'){
		wplc_at_export_settings();
	}

	if(isset($_GET['wplc_at_action']) && $_GET['wplc_at_action'] == 'export_history'){
		wplc_at_export_history();
	}

	if(isset($_GET['wplc_at_action']) && $_GET['wplc_at_action'] == 'export_ratings'){
		wplc_at_export_ratings();
	}

	if(isset($_GET['wplc_at_action']) && $_GET['wplc_at_action'] == 'export_offline_msg'){
		wplc_at_export_offline_msg();
	}
}

/**
 * Export Chat Settings
*/
function wplc_at_export_settings(){
	$wplc_settings_check = array(
		"WPLC_SETTINGS",
		"WPLC_SURVEY_SETTINGS",
		"WPLC_GA_SETTINGS",
		"WPLC_BANNED_IP_ADDRESSES",
		"wplc_advanced_settings",
		"WPLC_POWERED_BY",
		"WPLC_CUSTOM_CSS",
		"WPLC_CUSTOM_JS",
		"WPLC_DOC_SUGG_SETTINGS",
		"WPLC_PRO_SETTINGS",
		"WPLC_ACBC_SETTINGS",
		"WPLC_ENCRYPT_SETTINGS",
		"WPLC_INEX_SETTINGS",
		"WPLC_AUTO_RESPONDER_SETTINGS",
		"WPLC_ET_SETTINGS",
		"WPLC_SN_SETTINGS",
		"WPLC_ZENDESK_SETTINGS",
		"WPLC_CCTT_SETTINGS"
	);

	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=wplc_settings.csv');

	$output = @fopen('php://output', 'w');
	@fputcsv($output, array('OPTION', 'VALUE'));

	foreach ($wplc_settings_check as $key) {
		$current_setting = get_option($key, false);
		if($current_setting !== false){

			$insert = array(
				"OPTION" => $key,
				"VALUE" => maybe_serialize($current_setting)
			);

			@fputcsv($output, $insert);
		}
	}

	@fclose($output);
 	die();

}

/**
 * Export History
*/
function wplc_at_export_history(){
	global $wpdb;

	$wplc_tblname_chats_history = $wpdb->prefix . "wplc_chat_sessions";

	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=wplc_history.csv');

	$output = @fopen('php://output', 'w');

	@fputcsv($output, array('ID', 'Time', 'Name', 'Email', 'URL', 'Last Active', 'Agent ID', 'Department ID', 'Messages'));

	$results = $wpdb->get_results(
        "
        SELECT id, timestamp, name, email, url, last_active_timestamp, agent_id, department_id
        FROM $wplc_tblname_chats_history
        WHERE `status` = 1 OR `status` = 8
        ORDER BY `timestamp` DESC
      	", ARRAY_A
    );

	foreach ($results as $result) {
		if(function_exists("wplc_return_chat_messages")){
			$transcript = wplc_return_chat_messages($result['id'], false, false, false, false, 'string', false);
			$result['msg'] = strip_tags($transcript);
		}

 		@fputcsv($output, $result);
 	}

 	@fclose($output);
 	die();

}

/**
 * Export Ratings
*/
function wplc_at_export_ratings(){
	global $wpdb;

	$wplc_tblname_chats_ratings = $wpdb->prefix . "wplc_chat_ratings";

	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=wplc_ratings.csv');

	$output = @fopen('php://output', 'w');

	@fputcsv($output, array('Chat ID', 'Time', 'Agent ID', 'Rating', 'Comment'));

	$results = $wpdb->get_results(
        "
        SELECT cid, timestamp, aid, rating, comment
        FROM $wplc_tblname_chats_ratings
        ORDER BY `timestamp` DESC
      	", ARRAY_A
    );

	foreach ($results as $result) {
 		@fputcsv($output, $result);
 	}

 	@fclose($output);
 	die();

}

/**
 * Export Offline Messages
*/
function wplc_at_export_offline_msg(){
	global $wpdb;

	$wplc_tblname_chats_offline = $wpdb->prefix . "wplc_offline_messages";

	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=wplc_offline_msg.csv');

	$output = @fopen('php://output', 'w');

	@fputcsv($output, array('ID', 'Time', 'Name', 'Email', 'Message', 'IP'));

	$results = $wpdb->get_results(
        "
        SELECT id, timestamp, name, email, message, ip
        FROM $wplc_tblname_chats_offline
        ORDER BY `timestamp` DESC
      	", ARRAY_A
    );

	foreach ($results as $result) {
 		@fputcsv($output, $result);
 	}

 	@fclose($output);
 	die();

}