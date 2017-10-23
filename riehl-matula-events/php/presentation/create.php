<?php
	require '../logic/get/rooms.php';
	require '../logic/get/teams.php';
	require '../logic/get/outside_orgs.php';
	require '../logic/get/accessible_status.php';
?>


<?php
//<!DOCTYPE html>
//<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9" lang="en"><![endif]-->
//<!--[if IE 7]><html class="preIE8 preIE9" lang="en"><![endif]-->
//<!--[if IE 8]><html class="preIE9" lang="en"><![endif]-->
// <!--[if gte IE 9]><!--><html lang="en"><!--<![endif]-->
// 	<head>
// 		<meta charset="UTF-8" />
// 		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
// 		<meta name="viewport" content="width=device-width,initial-scale=1" />
// 			<title></title>
// 		<meta name="author" content="Sarah Schieffer Riehl" />
// 		<meta name="description" content="" />
// 		<meta name="keywords" content="" />
// 		<link rel="shortcut icon" href="/img/favicon.png" type="image/png" />
// 		<link rel="stylesheet" href="../../assets/css/style.css" type="text/css" />
// 	</head>
// 	<body>
?>
		<div class="wrap">
			<h2>Add New Event</h2>
			<!-- TODO: append front end validation messages inline with offending div -->
			<!-- if returned, set message from POST response -->
			<?php if (isset($messages)) { ?>
				<div class="message-box">
					<span class="message-close">x</span>
					<?php foreach($messages as $message) { ?>
						<div class="message-instance">
							<span><?php echo $message; ?></span>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
			<form method="POST" name="form_create_event" id="form_create_event">
				<!-- submit via ajax for ease of displaying back end error messages -->
				<div class='form-group-input-text form-group-level-1'>
					<label for="event_name" class="label-input-text">Event Name *</label>
					<input type="text" name="event_name" class="input-text" required/>
				</div>
				<div class='form-group-input-text form-group-level-1'>
					<label for="short_note" class="label-input-text">Short Note</label>
					<input type="text" placeholder="eg, date change, new location" name="short_note" class="input-text"/>
				</div>
				<div class='form-group-input-textarea form-group-level-1'>
					<label for="blurb" class="label-input-textarea">Event Description *</label>
					<textarea name="blurb" class="input-textarea" required></textarea>
				</div>
				<div class='form-group-level-1'>
					<div class='form-group-input-text-qlhelp form-group-level-2'>
						<label for="scheduled_date" class="label-input-text-qlhelp">Date &amp; Time Scheduled</label>
						<span class="help-input-text-qlhelp">Your event will not be displayed on the website until a date and time are added.  If you are requesting a room reservation, you'll have an opportunity to request a range of times later on.</span>
						<!--TODO-css-js: add datepicker -->
						<input type="date" name="scheduled_date" class="input-date"/>
					</div>
					<div class='form-group-input-text form-group-level-2'>
						<label for="duration" class="label-input-text">Duration</label>
						<!-- TODO-css-js: add timepicker -->
						<input type="date" name="duration" class="input-date"/>
					</div>
				</div>
				<div class="form-group-level-1 form-group-hidden-children" id="roomRequestContainer">
					<div class="form-group-switch form-group-level-2">
						<div class="input-switch">
							<input type="checkbox" class="input-switch-checkbox" name="room_request_boolean" />
							<label class="input-switch-slider"></label>
						</div>
						<span class="label-input-switch">Are you requesting a room at Wildflower?</span>
					</div>
					<div class='form-group-hidden form-group-level-2' id="roomRequestHidden">
						<!-- TODO-css-js: show and make at least one required if room request is checked -->
						<div class='form-group-input-multiple-container form-group-level-3'>
							<span class="label-input-multiple">Please rank rooms in order of preference</span>
							<div class='form-group-level-4 form-group-input-multiple'>
								<!-- TODO-php: add require of call to rooms db that defines $rooms as an associative array with the $id=>$roomname or possibly a multidimensional array depending on what is needed in other fields -->
								<?php foreach($rooms as $room) { ?>
									<div class='form-group-level-5 form-group-input-number form-group-loop form-group-rank'>
										<input type="number" class="input-number" name="<?php echo 'room_request_id-' . $room['id']; ?>" />
										<label class="label-input-number" for="<?php echo 'room_request_id-' . $room['id']; ?>"><?php echo $room['name']; ?></label>
									</div>
								<?php } ?>
							</div>
						</div>
						<div class='form-group-level-3 form-group-input-textarea'>
							<label for="request_date" class="label-input-textarea">Tell us about the dates and times you had in mind for this event *</label>
							<textarea class="input-textarea" name="request_date"></textarea>
						</div>
						<div class='form-group-level-3 form-group-input-number'>
							<input type="number" class="input-number" name="adult_attendees"/>
							<label for="adult_attendees" class="label-input-number">Estimated number of adult attendees</label>
						</div>
						<div class='form-group-level-3 form-group-input-number'>
							<input type="number" class="input-number" name="underage_attendees"/>
							<label for="underage_attendees" class="label-input-number">Estimated number of attendees under 18</label>
						</div>
						<div class="form-group-hidden-children form-group-level-3">
							<div class="form-group-switch form-group-level-4">
								<div class="input-switch">
									<input type="checkbox" class="input-switch-checkbox" name="repeating_res_boolean" />
									<label class="input-switch-slider"></label>
								</div>
								<span class="label-input-switch">Is this a repeating reservation?</span>
							</div>
							<div class='form-group-level-4 form-group-hidden form-group-input-multiple-container' id="recurrenceDetailsHidden">
								<!-- TODO-css-js: hide unless repeating reservation is checked -->
								<span class="label-input-multiple">Recurrence Details</span>
								<div class="form-group-level-5 form-group-multiple-switches">
									<div class="form-group-switch">
										<div class="input-switch">
											<input type="checkbox" class="input-switch-checkbox" name="weekly_res_boolean" />
											<label class="input-switch-slider"></label>
										</div>
										<span class="label-input-switch">Weekly Reservation</span>
									</div>
									<div class="form-group-switch">
										<div class="input-switch">
											<input type="checkbox" class="input-switch-checkbox" name="montly_res_boolean" />
											<label class="input-switch-slider"></label>
										</div>
										<span class="label-input-switch">Monthly Reservation</span>
									</div>
									<div class="form-group-switch">
										<div class="input-switch">
											<input type="checkbox" class="input-switch-checkbox" name="other_repeating_res_boolean" />
											<label class="input-switch-slider"></label>
										</div>
										<span class="label-input-switch">Other Repeating Reservation</span>
									</div>
								</div>
								<div class="form-group-level-5 form-group-hidden-children">
									<div class='form-group-level-6 form-group-input-select form-group-hidden' id="repeatWeekdayHidden">
										<!-- TODO-css-js: show and make required if weekly repeat is checked -->
										<label for="repeat_weekday" class="label-input-select">Which day of the week? *</label>
										<select name="repeat_weekday" class="input-select">
											<option value="Sunday">Sunday</option>
											<option value="Monday">Monday</option>
											<option value="Tuesday">Tuesday</option>
											<option value="Wednesday">Wednesday</option>
											<option value="Thursday">Thursday</option>
											<option value="Friday">Friday</option>
											<option value="Saturday">Satuday</option>
										</select>
									</div>
									<div class='form-group-level-6 form-group-input-text form-group-hidden' id="repeatMonthDayHidden">
										<!-- TODO-css-js: show and make required if monthly repeat is checked -->
										<label for="repeat_month_day" class="label-input-text">Which day of the month? *</label>
										<input type="text" class="input-text" name="repeat_month_day"/>
									</div>
									<div class='form-group-level-6 form-group-input-textarea form-group-hidden' id="repeatOtherHidden">
										<!-- TODO-css-js: show and make required if other repeat is checked -->
										<label for="repeat_other" class="label-input-textarea">Tell us more about the repeating schedule of this event *</label>
										<textarea class="input-textarea" name="repeat_other"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
						<div class='form-group-level-3 form-group-input-multiple-container'>
							<div class="form-group-level-4 form-group-input-multiple-container">
								<span class="label-input-multiple">
									Is this event hosted by a Wildflower Team? *
								</span>
								<!-- TODO: make radio switch required -->
								<div class="form-group-multiple-switches form-group-level-4">
									<div class="form-group-switch">
										<div class="input-switch">
											<input type="radio" class="input-switch-radio" name="hosting_org_code" value="1" required />
											<label class="input-switch-slider"></label>
										</div>
										<span class="label-input-switch">Yes, it's hosted by a Wildflower Team</span>
									</div>
									<div class="form-group-switch">
										<div class="input-switch">
											<input type="radio" class="input-switch-radio" name="hosting_org_code" value="2" />
											<label class="input-switch-slider"></label>
										</div>
										<span class="label-input-switch">No, it's an ad hoc gathering</span>
									</div>
									<div class="form-group-switch">
										<div class="input-switch">
											<input type="radio" class="input-switch-radio" name="hosting_org_code" value="3" />
											<label class="input-switch-slider"></label>
										</div>
										<span class="label-input-switch">No, it's hosted by an outside organization</span>
									</div>
								</div>
							</div>
							<div class='form-group-level-4 form-group-hidden-children'>
								<div class="form-group-input-select form-group-level-5 form-group-hidden" id="teamSelectHidden">
									<!-- TODO-css-js: show and make required if hosted by a team -->
									<label for="wfc_org_id" class="label-input-select">Wildflower Team</label>
									<select class="input-select" name="wfc_org_id">
										<!-- TODO-php: require php file that queries the teams table and returns an associative array of the ids and names as $teams, possibly with more info if required below -->
										<?php foreach($teams as $team) { ?>
											<option value="<?php echo 'team_id-' . $team['id'] ?>">
												<?php echo $team['name'] ?>
											</option>
										<?php } ?>
									</select>
								</div>
							</div>
							<!-- ad hoc gatherings have contact info only -->
							<div class='form-group-level-4 form-group-hidden-children form-group-hidden' id="outsideOrgHidden">
								<!-- TODO: show and make select required if outside org is checked -->
								<div class="form-group-input-select form-group-level-5 form-group-hidden">
									<label for="outside_org_id" class="label-input-select">Outside Organization</label>
									<select class="input-select" name="outside_org_id">
										<option value="0">
											Organization not listed
										</option>
										<!-- TODO-php: require php file that queries the outside orgs table and returns an associative array of the ids and names as $outside_orgs, possibly with more info if required below -->
										<?php foreach($outside_orgs as $org) { ?>
											<option value="<?php echo 'outside_org_id-' . $org['id'] ?>">
												<?php echo $org['name'] ?>
											</option>
										<?php } ?>
									</select>
								</div>
								<div class='form-group-input-multiple form-group-level-5 form-group-hidden' id="newOutsideOrgInputsHidden">
									<!-- TODO-js: show and make required if organization not listed -->
									<div class='form-group-input-text'>
										<label class="label-input-text" for="outside_org_name">Outside Organization Name</label>
										<input type="text" name="outside_org_name" class="input-text" />
									</div>
									<div class='form-group-input-text'>
										<label class="label-input-text" for="outside_org_website_link">Outside Organization Website/Social Media Link</label>
										<input type="url" name="outside_org_website_link" class="input-text"/>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group-level-1 form-group-input-multiple">
						<!--TODO-js: make either email or phone required -->
						<div class='form-group-input-text'>
							<label class="label-input-text" for="contact_name">Event Contact Name *</label>
							<input type="text" name="contact_name" class="input-text" />
						</div>
						<!-- TODO: require either email or phone -->
						<div class='form-group-input-text'>
							<label class="label-input-text" for="contact_email">Contact Email</label>
							<input type="email" name="contact_email" class="input-text"/>
						</div>
						<div class='form-group-input-text'>
							<label class="label-input-text" for="contact_phone">Contact Phone</label>
							<input type="tel" name="contact_phone" class="input-text"/>
						</div>
					</div>
					<div class="form-group-switch form-group-level-1">
						<div class="input-switch">
							<input type="checkbox" class="input-switch-checkbox" name="advocacy_boolean" />
							<label class="input-switch-slider"></label>
						</div>
						<span class="label-input-switch">Is this event an advocacy or demonstration action? *</span>
					</div>
					<div class="form-group-level-1 form-group-hidden-children">
						<div class="form-group-switch form-group-level-2">
							<div class="input-switch">
								<input type="checkbox" class="input-switch-checkbox" name="presenter_boolean" />
								<label class="input-switch-slider"></label>
							</div>
							<span class="label-input-switch">Does this event have a presenter? *</span>
						</div>
						<div class='form-group-input-multiple form-group-level-2 form-group-hidden' id="presenterInputsHidden">
							<!-- TODO-js: show and make name required if presenter switch checked -->
							<div class='form-group-input-text'>
								<label class="label-input-text" for="presenter_name">Presenter Name *</label>
								<input type="text" name="presenter_name" class="input-text" />
							</div>
							<div class='form-group-input-text'>
								<label class="label-input-text" for="presenter_link">Presenter Link</label>
								<input type="url" name="presenter_link" class="input-text" />
							</div>
							<div class='form-group-input-textarea'>
								<label class="label-input-textarea" for="presenter_bio">Presenter Bio</label>
								<textarea name="presenter_bio" class="input-textarea"></textarea>
							</div>
						</div>
					</div>
				<!-- TODO: don't show if room request  -->
					<div class='form-group-level-1 form-group-hidden-children'>
						<div class="form-group-switch">
							<div class="input-switch">
								<!-- TODO: default yes -->
								<input type="checkbox" class="input-switch-checkbox" name="on_campus_boolean" />
								<label class="input-switch-slider"></label>
							</div>
							<span class="label-input-switch">Is this event on the Wildflower campus? *</span>
						</div>
						<!-- TODO: if no, show and make location name and address mandatory  -->
						<div class='form-group-input-multiple form-group-level-2 form-group-hidden' id="outsideLocationInputsHidden">
							<div class='form-group-input-text'>
								<label for="outside_location_name" class="label-input-text">Outside Location Name *</label>
								<input type="text" name="outside_location_name" class="input-text" />
							</div>
							<div class='form-group-input-text'>
								<label for="outside_location_address" class="label-input-text">Outside Location Address *</label>
								<input type="text" name="outside_location_address" class="input-text" />
							</div>
							<div class='form-group-input-text'>
								<label for="outside_location_link" class="label-input-text">Outside Location Link</label>
								<input type="url" name="outside_location_link" class="input-text" />
							</div>
							<div class='form-group-input-textarea'>
								<label for="outside_location_blurb" class="label-input-textarea">About Outside Location</label>
								<textarea name="outside_location_blurb" class="input-textarea"></textarea>
							</div>>
							<div class='form-group-input-select'>
								<label for="accessible_status">Accessibility Status of Location</label>
								<select name="accessible_status" class="input-select">
									<!-- TODO-php: add require of call to accessibility db that defines $accessible_status as an associative array with the $id=>$status or possibly a multidimensional array depending on what is needed in other fields -->
									<?php foreach($accessible_status as $status) { ?>
										<option value="<?php echo 'accessible_status_id-' . $status['id']; ?>">
											<?php echo $status['status']; ?>
										</option>
									<?php } ?>
								</select>
							</div>
						</div>
						<!-- TODO: if yes (but not room requested), show and make WFC location stuff mandatory -->
						<div class='form-group-input-multiple form-group-level-2 form-group-hidden' id="onCampusRoomInputsHidden">
							<div class='form-group-select'>
								<label for="on_campus_room_id" class="label-input-select">On Campus Room *</label>
								<select name="on_campus_room_id" class="input-select">
									<!-- TODO-php: add require of call to room db that defines $rooms as an associative array with the $id=>$room_name or possibly a multidimensional array depending on what is needed in other fields -->
									<?php foreach($rooms as $room) { ?>
										<option value="<?php echo 'room_id-' . $room['id']; ?>">
											<?php echo $room['name']; ?>
										</option>
									<?php } ?>
								</select>
							</div>
							<div class="info-group form-group-hidden-children form-group-hidden" id="onCampusAccessibleStatusContainerHidden">
								<!-- TODO-js: show/hide room accessibility status based on selection -->
								<?php foreach($rooms as $room) { ?>
									<span class="accessible_desc form-group-hidden" id="<?php echo 'roomId' . $room['id']; ?>">
										<?php echo $room['accessible_status']; ?>
									</span>
								<?php } ?>

							</div>
						</div>
					</div>
					<div class='form-group-level-1 form-group-multiple-switches'>
						<div class="form-group-switch">
							<div class="input-switch">
								<!-- TODO: default yes, popup on submit to confirm -->
								<input type="checkbox" class="input-switch-checkbox" name="family_friendly_boolean" />
								<label class="input-switch-slider"></label>
							</div>
							<span class="label-input-switch">Is this event family friendly? (Does the activity itself include children?)</span>
						</div>
						<div class="form-group-switch">
							<div class="input-switch">
								<!-- TODO: default yes, popup on submit to confirm -->
								<input type="checkbox" class="input-switch-checkbox" name="childcare_boolean" />
								<label class="input-switch-slider"></label>
							</div>
							<span class="label-input-switch">Is childcare provided? (You can edit this later if something changes)</span>
						</div>
					</div>
				<div class='form-group-level-1 form-group-hidden-children'>
					<div class="form-group-switch">
						<div class="input-switch">
							<input type="checkbox" class="input-switch-checkbox" name="language_boolean" />
							<label class="input-switch-slider"></label>
						</div>
						<span class="label-input-switch">Are translation services provided?</span>
					</div>
					<!-- TODO: if so, show below and require -->
					<div class='form-group-level-2 form-group-hidden form-group-input-multiple' id="languageInputHidden">
						<span class="label-input-multiple">For which languages? *</span>
						<div class='form-group-switches-multiple'>
							<!-- TODO-php: add require of call to languages db that defines $languages as an associative array with the $id=>$language or possibly a multidimensional array depending on what is needed in other fields -->
							<?php foreach($languages as $language) { ?>
								<div class="form-group-switch">
									<div class="input-switch">
										<input type="checkbox" class="input-switch-checkbox" name="<?php echo 'language_id-' . $language['id']; ?>" />
										<label class="input-switch-slider"></label>
									</div>
									<span class="label-input-switch"><?php echo $language['language']; ?></span>
								</div>
							<?php } ?>
							<div class="form-group-switch">
								<div class="input-switch">
									<input type="checkbox" class="input-switch-checkbox" name="new_language" />
									<label class="input-switch-slider"></label>
								</div>
								<span class="label-input-switch">Enter New Language</span>
							</div>
						</div>
						<!-- TODO: if new language, show input below -->
						<div class='form-group-input-text input-hidden' id="newLanguageInputHidden">
							<label for="new_language" class="label-input-text">Language Name</label>
							<input type="text" name="new_language" class="input-text" />
						</div>
					</div>
				</div>
				<div class='form-group-level-1 form-group-input-text'>
					<label for="hashtag" class="label-input-text">Hashtag (optional)</label>
					<input type="text" name="hashtag" class="input-text" />
				</div>
				<div class="button-container">
					<button type='submit' class='button-primary'>Save Event</button>
				</div>
			</form>
		</div>
		<script src="/wp-includes/js/jquery/jquery.js" type="text/javascript"></script>
		<script src="../../assets/js/create.js" type="text/javascript"></script>
	<?php
	//</body>
//</html>
?>
