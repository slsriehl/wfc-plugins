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

		$family_friendly_boolean = 0;
		if(trim($_POST["family_friendly_boolean"]) == '1') {
			$family_friendly_boolean = 1;
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
								'scheduled_date'   => date('Y-m-d H:i', strtotime($scheduled_date)),
								'duration'      => date('H:i', strtotime($duration)),
								'short_note'      => $short_note,
								'blurb' => $blurb,
								'hosting_org_code'      => $hosting_org_code,
								'wfc_org_id'     => $wfc_org_id,
								'outside_org_id' => $outside_org_id,
								'advocacy_demonstration_boolean' => $advocacy_demonstration_boolean,
								'presenter_name'     => $presenter_name,
								'presenter_link'      => $presenter_link,
								'presenter_bio'	=> $presenter_bio,
								'on_campus_boolean' => $on_campus_boolean,
								'on_campus_room_id'         => $on_campus_room_id,
								'outside_venue'   => $outside_venue,
								'map_url'      => $map_url,
								'info_link'     => $info_link,
								'family_friendly_boolean' => $family_friendly_boolean,
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
					showOrgFields(document.getElementByName('outside_org_boolean').getAttribute('value'));
				</script>
				<div class="wrap">
					<h2>Add New Event</h2>
					<?php if (isset($message)): ?>
						<div class="updated"><p><?php echo $message; ?></p></div>
					<?php endif; ?>
					<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
						<div class='form-group'>
							<label>Event Name *</label>
							<input type="text" name="event_name" class="ss-field-width" required/>
						</div>
						<div class='form-group'>
							<label>Short Note</label>
							<input type="text" placeholder="eg, date change, new location" name="short_note" class="ss-field-width"/>
						</div>
						<div class='form-group'>
							<label>Event Description</label>
							<textarea type="text" placeholder="eg, date change, new location" name="" class="ss-field-width"></textarea>
						</div>
						<div class='form-group'>
							<label>Date &amp; Time Scheduled</label>
							<span>Your event will not be displayed on the website until a date and time are added.</span>
							<input type="date" name="scheduled_date" class="ss-field-width"/>
						</div>
						<div class='form-group'>
							<label>Duration <span>*</span></label>
							<!-- TODO: add duration picker -->
							<input type="text" name="duration" class="ss-field-width" required/>
						</div>
						<div class='form-group'>
							<input type="checkbox" name="request_room_boolean"/>
							<span>&nsbp;</span>
							<label>Request Room</label>
							<!-- TODO: duration required if room requested -->
						</div>
						<div class='form-group'>
							<!-- TODO: make all these required if room requested is checked -->
							<div class='form-group'>
								<label>Room Requested</label>
								<select name="wfc_org_id">
									<option value="<?php room id ?>"><?php room name ?></option>
									<!-- TODO: etc with values as ids rooms db -->
								</select>
							</div>
							<div class='form-group'>
								<label>Estimated number of adult attendees</label>
								<input type="number" name="adult_attendees"/>
							</div>
							<div class='form-group'>
								<label>Estimated number of underage attendees</label>
								<input type="number" name="underage_attendees"/>
							</div>
							<div class='form-group'>
								<input type="checkbox" name="repeating_res_boolean"/>
								<span>&nsbp;</span>
								<label>Is this a repeating reservation?</label>
								<!-- TODO: show following group if selected -->
							</div>
							<div class='form-group'>
								<p>Recurrence Details</p>
								<div class='form-group'>
									<input type="checkbox" name="weekly_repeat_boolean"/>
									<span>&nsbp;</span>
									<label>Weekly Reservation</label>
									<!-- TODO: show following group and hide monthly res if selected -->
								</div>
								<div class='form-group'>
									<label>Which day of the week?</label>
									<select name="repeat_weekday">
										<option value="Sunday">Sunday</option>
										<option value="Monday">Monday</option>
										<option value="Tuesday">Tuesday</option>
										<option value="Wednesday">Wednesday</option>
										<option value="Thursday">Thursday</option>
										<option value="Friday">Friday</option>
										<option value="Saturday">Satuday</option>
									</select>
								</div>
								<div class='form-group'>
									<input type="checkbox" name="monthly_repeat_boolean"/>
									<span>&nsbp;</span>
									<label>Monthly Reservation</label>
									<!-- TODO: show following group if selected -->
								</div>
								<div class='form-group'>
									<label>Which day of the month?</label>
									<input type="text" name="repeat_month_day"/>
								</div>
							</div>
						</div>
						<div class='form-group'>
							<p>Is this event hosted by a Wildflower Team? *</p>
							<div class='form-group'>
								<input type="radio" name="hosting_org_code" value="0" checked="checked" required/>
								<span>&nsbp;</span>
								<label>Yes, it's hosted by a Wildflower Team</label>
							</div>
							<div class='form-group'>
								<input type="radio" name="hosting_org_code" value="2" required/>
								<span>&nsbp;</span>
								<label>No, it's an ad hoc gathering</label>
							</div>
							<div class='form-group'>
								<input type="radio" name="hosting_org_code" value="1" required/>
								<span>&nsbp;</span>
								<label>No, it's hosted by an outside organization</label>
							</div>
						</div>
						<div class='form-group' id="wfcOrgInfo">
							<div class='form-group'>
								<label>Wildflower Team</label>
								<select name="wfc_org_id">
									<option value="<?php org id ?>"><?php org name ?></option>
									<!-- TODO: etc with values as ids from teams db -->
								</select>
							</div>
							<!-- TODO: wfc contact info, pick from select from db or enter new -->
						</div>
						<div class='form-group' id="outsideOrgInfo">
							<div class='form-group'>
								<label>Select an Outside Organization</label>
								<select name="wfc_org_id">
									<option value="<?php org id ?>"><?php org name ?></option>
									<!-- TODO: etc with values as ids from outside org db -->
									<option value="0">Create a new outside organization</option>
								</select>
							</div>
							<div class='form-group'>
								<div class='form-group'>
									<label>Outside Organization Name</label>
									<input type="text" name="outside_org_name" class="ss-field-width" required/>
								</div>
								<div class='form-group'>
									<label>Outside Organization Website Link</label>
									<input type="url" name="outside_org_website_link" class="ss-field-width" required/>
								</div>
								<div class='form-group'>
									<label>Outside Organization Social Link</label>
									<input type="url" name="outside_org_social_link" class="ss-field-width" required/>
								</div>
							</div>
							<div class='form-group'>
								<div class='form-group'>
									<label>Outside Organization Contact Name</label>
									<input type="text" name="outside_org_contact_name" class="ss-field-width" required/>
								</div>
								<div class='form-group'>
									<label>Outside Organization Contact Email</label>
									<input type="url" name="outside_org_contact_email" class="ss-field-width" required/>
								</div>
								<div class='form-group'>
									<label>Outside Organization Contact Phone</label>
									<input type="url" name="outside_org_contact_phone" class="ss-field-width" required/>
								</div>
							</div>
						</div>
						<div class='form-group'>
							<p>Is this event an advocacy or demonstration action? *</p>
							<div class='form-group'>
								<div class='form-group'>
									<input type="radio" name="advocacy_demonstration_boolean" value="0" checked="checked" required/>
									<span>&nsbp;</span>
									<label>Yes</label>
								</div>
								<div class='form-group'>
									<input type="radio" name="advocacy_demonstration_boolean" value="1" required/>
									<span>&nsbp;</span>
									<label>No</label>
								</div>
							</div>
						</div>
						<div class='form-group'>
							<div class='form-group'>
								<p>Does this event have a presenter?</p>
								<!-- TODO: show below group if presenter and require name -->
								<div class='form-group'>
									<div class='form-group'>
										<input type="radio" name="presenter_boolean" value="0" checked="checked" required/>
										<span>&nsbp;</span>
										<label>Yes</label>
									</div>
									<div class='form-group'>
										<input type="radio" name="presenter_boolean" value="1" required/>
										<span>&nsbp;</span>
										<label>No</label>
									</div>
								</div>
							</div>
							<div class='form-group'>
								<div class='form-group'>
									<label>Presenter Name *</label>
									<input type="text" name="presenter_name" class="ss-field-width" required/>
								</div>
								<div class='form-group'>
									<label>Presenter Link</label>
									<input type="url" name="presenter_link" class="ss-field-width" required/>
								</div>
								<div class='form-group'>
									<label>Presenter Bio</label>
									<textarea name="presenter_bio" class="ss-field-width"></textarea>
								</div>
							</div>
						</div>
						<div class='form-group'>
							<div class='form-group'>
								<p>Is this event on the Wildflower campus?</p>
								<!-- TODO: show correct group below based on answer -->
								<div class='form-group'>
									<div class='form-group'>
										<input type="radio" name="on_campus_boolean" value="0" checked="checked" required/>
										<span>&nsbp;</span>
										<label>Yes</label>
									</div>
									<div class='form-group'>
										<input type="radio" name="on_campus_boolean" value="1" required/>
										<span>&nsbp;</span>
										<label>No</label>
									</div>
								</div>
								<!-- TODO: if no, make location name and address mandatory  -->
								<div class='form-group'>
									<div class='form-group'>
										<label>Location *</label>
										<input type="text" name="outside_location_name" class="ss-field-width" required/>
									</div>
									<div class='form-group'>
										<label>Location Address *</label>
										<input type="text" name="outside_location_address" class="ss-field-width" required/>
									</div>
									<div class='form-group'>
										<label>Location Link</label>
										<input type="url" name="outside_location_link" class="ss-field-width" />
									</div>
									<div class='form-group'>
										<label>About Outside Location</label>
										<textarea name="outside_location_blurb" class="ss-field-width"></textarea>
									</div>
								</div>
								<!-- TODO: if yes, show and make WFC location stuff mandatory -->
								<div class='form-group'>
									<label>On Campus Room *</label>
									<span>If you have requested a room but not yet received an assignment, please leave this blank.</span>
									<select name="on_campus_room_id">
										<option value="<?php room id ?>"><?php room name ?></option>
										<!-- TODO: etc with values as ids rooms db -->
									</select>
								</div>
							</div>
							<div class='form-group'>
								<div class='form-group'>
									<p>Is this event family friendly? (Does the activity itself include children?  Childcare availability is separate.)</p>
									<div class='form-group'>
										<div class='form-group'>
											<input type="radio" name="on_campus_boolean" value="0" checked="checked" required/>
											<span>&nsbp;</span>
											<label>Yes</label>
										</div>
										<div class='form-group'>
											<input type="radio" name="on_campus_boolean" value="1" required/>
											<span>&nsbp;</span>
											<label>No</label>
										</div>
									</div>
								</div>
								<!-- TODO: if the event is not family friendly, does it include childcare? -->
								<div class='form-group'>
									<p>Is childcare provided?</p>
									<div class='form-group'>
										<div class='form-group'>
											<input type="radio" name="on_campus_boolean" value="0" checked="checked" required/>
											<span>&nsbp;</span>
											<label>Yes</label>
										</div>
										<div class='form-group'>
											<input type="radio" name="on_campus_boolean" value="1" required/>
											<span>&nsbp;</span>
											<label>No</label>
										</div>
									</div>
								</div>
							</div>
							<div class='form-group'>
								<div class='form-group'>
									<p>Are translation services provided?</p>
									<div class='form-group'>
										<div class='form-group'>
											<input type="radio" name="on_campus_boolean" value="0" checked="checked" required/>
											<span>&nsbp;</span>
											<label>Yes</label>
										</div>
										<div class='form-group'>
											<input type="radio" name="on_campus_boolean" value="1" required/>
											<span>&nsbp;</span>
											<label>No</label>
										</div>
									</div>
								</div>
								<!-- TODO: if so, show below and require -->
								<div class='form-group'>
									<p>For which languages *</p>
									<div class='form-group'>
										<!-- TODO: iterate checkboxes for languages -->
										<div class='form-group'>
											<input type="checkbox" name="on_campus_boolean" value="<?php language id ?>" />
											<span>&nsbp;</span>
											<label><?php language name ?></label>
										</div>
										<div class='form-group'>
											<input type="checkbox" name="on_campus_boolean" value="0" />
											<span>&nsbp;</span>
											<label>New Language</label>
										</div>
									</div>
									<!-- TODO: if new language, show input below -->
									<div class='form-group'>
										<label>Language Name</label>
										<input type="text" name="on_campus_boolean" value="0" />
									</div>
								</div>
								<!-- TODO: accessibility -->
								<!-- TODO: hashtag -->
							</div>
						</div>
						<input type='submit' name="insert" value='Save' class='button-primary'>
					</form>
				</div>
				<?php
		}
}
