<!DOCTYPE html>
<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9" lang="en"><![endif]-->
<!--[if IE 7]><html class="preIE8 preIE9" lang="en"><![endif]-->
<!--[if IE 8]><html class="preIE9" lang="en"><![endif]-->
<!--[if gte IE 9]><!--><html lang="en"><!--<![endif]-->
  			<head>
    			<meta charset="UTF-8" />
  				<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  				<meta name="viewport" content="width=device-width,initial-scale=1" />
    				<title></title>
  				<meta name="author" content="Sarah Schieffer Riehl" />
  				<meta name="description" content="" />
  				<meta name="keywords" content="" />
  				<link rel="shortcut icon" href="img/favicon.png" type="image/png" />
  				<link rel="stylesheet" href="css/style.css" type="text/css" />
  			</head>
  			<body>
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
						<form method="POST" action="../logic/create.php">
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
										<input type="checkbox" class="input-switch-checkbox" name="room_request_boolean" value="1" />
										<label class="input-switch-slider"></label>
									</div>
									<span class="label-input-switch">Are you requesting a room at Wildflower?</span>
								</div>
								<div class='form-group-hidden form-group-level-2' id="roomRequestHidden">
									<!-- TODO-css-js: hide unless room request is checked -->
									<div class='form-group-input-multiple-container form-group-level-3'>
										<span class="label-input-multiple">Please rank rooms in order of preference</span>
										<div class='form-group-level-4 form-group-input-multiple'>
											<!-- TODO-php: add require of call to rooms db that defines $rooms as an associative array with the $id=>$roomname or possibly a multidimensional array depending on what is needed in other fields -->
											<?php foreach($rooms as $id=>$room_name) { ?>
												<div class='form-group-level-5 form-group-input-number form-group-loop form-group-rank'>
													<input type="number" class="input-number" name="<?php echo 'room_request_id-' . $id; ?>" />
													<label class="label-input-number" for="<?php echo 'room_request_id-' . $id; ?>"><?php echo $room_name; ?></label>
												</div>
											<?php } ?>
										</div>
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
													<!-- TODO-css-js: show if weekly repeat is checked -->
													<label for="repeat_weekday" class="label-input-select">Which day of the week?</label>
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
													<!-- TODO-css-js: show if monthly repeat is checked -->
													<label for="repeat_month_day" class="input-label-text">Which day of the month?</label>
													<input type="text" class="input-text" name="repeat_month_day"/>
												</div>
												<div class='form-group-level-6 form-group-input-textarea form-group-hidden' id="repeatOtherHidden">
													<!-- TODO-css-js: show if other repeat is checked -->
													<label for="repeat_other" class="input-label-textarea">Tell us more about the repeating schedule of this event</label>
													<textarea class="input-textarea" name="repeat_other"></textarea>
												</div>
											</div>
										</div>
									</div>
									<div class='form-group-level-3 form-group-input-multiple-container'>
										<div class="form-group-level-4 form-group-input-multiple-container">
											<span class="label-input-multiple">
												Is this event hosted by a Wildflower Team? *
											</span>
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
												<!-- TODO-css-js: show if hosted by a team -->
												<label for="wfc_org_id" class="label-input-select">Wildflower Team</label>
												<select class="input-select" name="wfc_org_id">
													<!-- TODO-php: require php file that queries the teams table and returns an associative array of the ids and names as $teams, possibly with more info if required below -->
													<?php foreach($teams as $id=>$team) { ?>
														<option value="<?php echo 'team_id-' . $id ?>">
															<?php echo $team ?>
														</option>
													<?php } ?>
												</select>
											</div>
											<div class="form-group-level-5 form-group-input-multiple-container form-group-hidden" id="wildflowerContactHidden">
											<!-- TODO-css-js: show if wfc team or ad hoc is checked -->
												<span class="label-input-multiple">
													Select a Wildflower contact or enter a new one
												</span>
												<div class="form-group-level-6 form-group-select">
													<label for="existing_wfc_contact" class="label-input-select">Existing Contacts</label>
													<select class="input-select" name="existing_wfc_contact">
														<!-- TODO-php: require php file that queries the wfc_contacts table and returns an associative array of the ids and names as $wfc_contacts, possibly with more info if required below -->
														<!-- TODO-js: allow typing in select input to search autocomplete of existing contact names -->
														<?php foreach($wfc_contacts as $id=>$contact_name) { ?>
															<option value="<?php echo 'wfc_contact_id-' . $id ?>">
																<?php echo $contact_name ?>
															</option>
														<?php } ?>
													</select>
												</div>
												<div class="form-group-level-6 form-group-switch">
													<div class="input-switch">
														<input type="checkbox" class="input-switch-checkbox" name="wfc_contact_exists_boolean" />
														<label class="input-switch-slider"></label>
													</div>
													<span class="label-input-switch">This contact is not listed above</span>
												</div>
												<!-- TODO-continue: ended work 10/19/17 -->
											</div>
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
								<!-- TODO: add select to show enter a contact if this organization already exists plus switch for not shown -->
							</div>
							<div class="form-group-level-7 form-group-input-multiple form-group-hidden" id="enterNewContact">
								<!-- TODO-css-js: show if contact not listed above is checked -->
								<span class="label-input-multiple">
									Enter a new contact
									<!-- TODO: automatically detect wfc or this entered organization -->
							</div>
						</div>
							<div class="payment__switch__container form-group">
								<div class="payment--switch">
									<!-- TODO: default yes, popup on submit to confirm -->
									<input type="checkbox" class="payment--checkbox" name="advocacy_boolean" />
									<label for="advocacy_boolean" class="payment--slider"></label>
								</div>
								<span class="payment--p">Is this event an advocacy or demonstration action? *</span>
							</div>
							<div class='form-group'>
								<div class="form-group-switch">
									<div class="input-switch">
										<!-- TODO: default yes, popup on submit to confirm -->
										<input type="checkbox" class="input-switch-checkbox" name="advocacy_boolean" />
										<label for="advocacy_boolean" class="input-switch-slider"></label>
									</div>
									<span class="label-input-switch">Does this event have a presenter? *</span>
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
							<!-- TODO: don't show if room request  -->
							<div class='form-group'>
								<div class='form-group'>
									<div class="form-group-switch">
										<div class="input-switch">
											<!-- TODO: default yes, popup on submit to confirm -->
											<input type="checkbox" class="input-switch-checkbox" name="advocacy_boolean" />
											<label for="advocacy_boolean" class="input-switch-slider"></label>
										</div>
										<span class="label-input-switch">Is this event on the Wildflower campus? *</span>
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
									<!-- TODO: if yes (but not room requested), show and make WFC location stuff mandatory -->
									<div class='form-group'>
										<label>On Campus Room *</label>
										<span>If you have requested a room but not yet received an assignment, please leave this blank.</span>
										<select name="on_campus_room_id">
											<option value="<?php room id ?>"><?php room name ?></option>
											<!-- TODO: etc with values as ids rooms db -->
										</select>
									</div>
								</div>
							</div>
							<!-- TODO: accessibility: show once location is selected -->
							<div class='form-group'>
								<?php if on campus/ room request ?>
									<?php loop rooms selected, room request ?>
										<div class='form-group'>
											<label>Accessibility Status of <?php insert room selected ?></label>
											<span type="text" <?php same class as inputs ?> name="accessibility_display" value="<?php insert from db, key of status from room join  ?>"><?php insert text of accessibility status of room ?>
												<?php insert from db, value of accessibility from room join ?>
											</span>
										</div>
									<?php end loop rooms selected ?>
								<?php else if in not on campus/room request, save to outside location ?>
									<div class='form-group'>
										<label>Accessibility Status of <?php either "outside location" or location name provided ?></label>
										<?php if no name or id of outside location given, show this ?>
											<span>Please select an outside location or enter a new one</span>
										<?php else if name but not id ?>
											<select name="new_accessibility">
												<?php loop accessibility options ?>
													<option value="<?php value from accessibility db?>"><?php text from accessibility db ?></option>
												<?php end loop accessibility options ?>
											</select>
										<?php end if name/id ?>
									</div>
								<?php endif ?>
							</div>
							<div class='form-group'>
								<div class="form-group-switch">
									<div class="input-switch">
										<!-- TODO: default yes, popup on submit to confirm -->
										<input type="checkbox" class="input-switch-checkbox" name="advocacy_boolean" />
										<label for="advocacy_boolean" class="input-switch-slider"></label>
									</div>
									<span class="label-input-switch">Is this event family friendly? (Does the activity itself include children?  Childcare availability is separate.) *</span>
								</div>
								<!-- TODO: if the event is not family friendly, does it include childcare? -->
								<div class="form-group-switch">
									<div class="input-switch">
										<!-- TODO: default yes, popup on submit to confirm -->
										<input type="checkbox" class="input-switch-checkbox" name="advocacy_boolean" />
										<label for="advocacy_boolean" class="input-switch-slider"></label>
									</div>
									<span class="label-input-switch">Is childcare provided? (You can edit this later if something changes)</span>
								</div>
							</div>
							<div class='form-group'>
								<div class='form-group'>
									<div class="payment__switch__container">
										<div class="payment--switch">
											<input type="checkbox" class="payment--checkbox" name="language_boolean" />
											<label for="view-line-items" class="payment--slider"></label>
										</div>
										<span class="payment--p">Are translation services provided?</span>
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
							</div>
							<div class='form-group'>
								<label>Hashtag (optional)</label>
								<input type="text" name="on_campus_boolean" value="0" />
							</div>
							<input type='submit' name="insert" value='Save' class='button-primary'>
						</form>
					</div>
  			</body>
</html>
