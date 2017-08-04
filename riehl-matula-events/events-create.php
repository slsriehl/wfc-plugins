<?php

function events_create()
{
    $event_name = trim($_POST["event_name"]);
    $scheduled_date = trim($_POST["scheduled_date"]);
    $start_time = trim($_POST["start_time"]);
    $end_time = trim($_POST["end_time"]);
		//split start time string to give 24-hour start hour
		$start_hour = null;
		$start_arr = explode(':', $start_time);
		$start_ampm = explode(' ', $start_time);
		if($start_ampm[1] == 'am' && $start_arr[0] != 12) {
			$start_hour = $start_arr[0]
		} elseif($start_ampm[1] == 'am') {
			$start_hour = 0;
		} else {
			$start_hour = intval($start_arr[0]) + 12;
		}

		$short_note = trim($_POST["short_note"]);
		$blurb = trim($_POST["blurb"]);
		//org name and org link if outside organization, else wfc org id
		$organization_name = null;
		$organization_link = null;
		$outside_org_boolean = 1;
		$wfc_org_id = null;
		if(trim($_POST["outside_org_link"])) {
			$organization_link = trim($_POST["outside_org_link"]);
			$organization_name = trim($_POST["outside_org_name"]);
		} elseif(trim($_POST["outside_org_name"])) {
			$organization_name = trim($_POST["outside_org_name"]);
		} else {
			$wfc_org_id = trim($_POST["wfc_org_id"]);
			$outside_org_boolean = 0;
		}

		$presenter_link = null;
		$presenter_name = null;
		if(trim($_POST["presenter_link"])) {
			$presenter_link = trim($_POST["presenter_link"]);
			$presenter_name = trim($_POST["presenter_name"]);
		} elseif(trim($_POST["presenter_name"])) {
			$presenter_name = trim($_POST["presenter_name"]);
		}

		$on_campus_boolean = 0;
		$on_campus_room_id = null;
		$outside_venue = null;
		$map_url = null;
		if(trim($_POST["on_campus_boolean"]) == '1') {
			$on_campus_boolean = 1;
			$on_campus_room_id = trim($_POST["on_campus_room_id"]);
		} else {
			$outside_venue = trim($_POST["outside_venue"]);
			$map_url = trim($_POST["map_url"]);
		}

		$info_link = null;
		if(trim($_POST["info_link"])) {
			$info_link = trim($_POST["info_link"]);
		}

		$childcare_boolean = 0;
		if(trim($_POST["childcare_boolean"]) == '1') {
			$childcare_boolean = 1;
		}

		$language_id = null;
		if(trim($_POST["language_id"])) {
			$language_id =  trim($_POST["language_id"]);
		}

		$accessibility_boolean = 0;
		if(trim($_POST["accessibility_boolean"]) == '1') {
			$accessibility_boolean =  1;
		}

		$contact_person = trim($_POST["contact_person"]);
		$contact_email = null;
		$contact_phone = null;
		if(trim($_POST["contact_email"]) && trim($_POST["contact_phone"])) {
			$contact_email = trim($_POST["contact_email"]);
			$contact_phone = trim($_POST["contact_phone"]);
		} elseif(trim($_POST["contact_email"])) {
			$contact_email = trim($_POST["contact_email"]);
		} else {
			$contact_phone = trim($_POST["contact_phone"]);
		}

		$hashtag = null;
		if(trim($_POST["hashtag"])) {
			$hashtag = trim($_POST["hashtag"]);
		}


    //insert
    if (isset($_POST['insert'])) {
        global $wpdb;
        $table_name = 'events';

        $wpdb->insert(
            $table_name, //table
            array(
                'event_name'         => $event_name,
                'scheduled_date'   => date('Y-m-d', strtotime($scheduled_date)),
                'start_time'      => date('H:i', strtotime($start_time)),
                'end_time'     => date('H:i', strtotime($end_time)),
                'start_hour'     => $start_hour,
                'short_note'      => $short_note,
                'blurb' => $blurb,
								'organization_name'         => $organization_name,
                'organization_link'   => $organization_link,
                'outside_org_boolean'      => $outside_org_boolean,
                'wfc_org_id'     => $wfc_org_id,
                'presenter_name'     => $presenter_name,
                'presenter_link'      => $presenter_link,
                'on_campus_boolean' => $on_campus_boolean,
								'on_campus_room_id'         => $on_campus_room_id,
                'outside_venue'   => $outside_venue,
                'map_url'      => $map_url,
                'info_link'     => $info_link,
                'childcare_boolean'     => $childcare_boolean,
                'language_id'      => $language_id,
                'accessibility_boolean' => $accessibility_boolean,
								'contact_person'         => $contact_person,
                'contact_email'   => $contact_email,
								//sanitize
                'contact_phone'      => $contact_phone,
								//sanitize
                'hashtag'     => $hashtag
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ), //data
            array('%s', '%s', '%s') //data format
        );
        ?>
        <div class="updated"><p>Event added!</p></div>
        <a href="<?php echo admin_url('admin.php?page=events_list') ?>">&laquo; Back to events list</a>
        <?php
    } else {
        ?>
        <link type="text/css" href="<?php echo WP_PLUGIN_URL ?>/riehl-matula-events/style-admin.css" rel="stylesheet"/>
				<script>
				function showOrgFields(orgBooleanValue) {
					  if(orgBooleanValue == '0')  {
							document.getElementById('wfcOrgInfo').style.display = 'block';
							document.getElementById('outsideOrgInfo').style.display = 'none';
							return;
						} else {
							document.getElementById('wfcOrgInfo').style.display = 'none';
							document.getElementById('outsideOrgInfo').style.display = 'block';
							return;
						}
					}
					showOrgFields(document.getElementByName(['outside_org_boolean']).getAttribute('value'));
				</script>
        <div class="wrap">
            <h2>Add New Event</h2>
            <?php if (isset($message)): ?>
                <div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class='wp-list-table widefat fixed'>
                    <tr>
                        <th class="ss-th-width">Event Name *</th>
                        <td><input type="text" name="event_name" class="ss-field-width" required/></td>
                    </tr>
                    <tr>
                        <th class="ss-th-width">Scheduled Date *</th>
                        <td>
													<td>
															<input type="date" name="scheduled_date" class="ss-field-width" required/>
													</td>
                        </td>
                    </tr>
                    <tr>
                        <th class="ss-th-width">Start Time *</th>
                        <td><input type="text" name="start_time" placeholder="hh:mm am/pm" pattern="/^([0-1]\d):([0-5]\d)\s?(?:AM|PM)?$/i" class="ss-field-width" required/>
                        </td>
                    </tr>
                    <tr>
                        <th class="ss-th-width">End Time *</th>
												<td><input type="text" name="end_time" placeholder="hh:mm am/pm" pattern="/^([0-1]\d):([0-5]\d)\s?(?:AM|PM)?$/i" class="ss-field-width" required/>
                        </td>
                    </tr>
                    <tr>
                        <th class="ss-th-width">Short Note</th>
                        <td><input type="text" placeholder="eg, date change, new location" name="short_note" class="ss-field-width"/>
                        </td>
                    </tr>
											<th class="ss-th-width">Is this event hosted by a Wildflower Team? *</th>
											<td>
												<input type="radio" name="outside_org_boolean" value="0" checked="checked" required/> <label>Yes, it's hosted by a Wildflower Team</label>
												<input type="radio" name="outside_org_boolean" value="1" required/> <label>No, it's hosted by an outside organization</label>
											</td>
											<div id="wfcOrgInfo">
												<label>Wildflower Team</label>
												<select name="wfc_org_id">
													<option value="1">Justice Team</option>
													<!-- etc with values as ids from teams db -->
												</select>
											</div>
											<div id="outsideOrgInfo">
												<label>Outside Organization Name</label>
												<input type="text" name="organization_name" class="ss-field-width" required/>
												<label>Outside Organization Link</label>
												<input type="url" name="organization_link" class="ss-field-width" required/>
											</div>
                    <tr>
                        <th class="ss-th-width">Date Scheduled</th>
                        <td>
                            <input type="date" name="scheduled_for" class="ss-field-width"/>
                        </td>
                    </tr>
                </table>
                <input type='submit' name="insert" value='Save' class='button-primary'>
            </form>
        </div>
        <?php
    }
}
