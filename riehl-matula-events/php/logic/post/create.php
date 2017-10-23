<?php

	require('../helpers/create_outside_org');
	require('../helpers/parse_id');
	require('../calendar/on_campus_location');
	require('../calendar/all_events');

//using php://input instead of $form_data to handle ajax json
if(getenv('REQUEST_METHOD') == 'POST') {
	$form_data = file_get_contents("php://input");
}
var_dump($form_data);

global $wpdb;

function create_room_request() {
	//if room request, save to db and return the id to save to create event
}

function get_languages() {
	//loop the names of the checkboxes by the length of the language table, pushing existing ids to an array, creating entries for new ids and pushing their values to the array, returning the array
}

function create_event() {
	//create sanitized variables from php://input
	$event_name = trim($form_data["event_name"]);

	if(isset($form_data["short_note"])) {
		$short_note = trim($form_data["short_note"]);
	}

	$blurb = trim($form_data["blurb"]);

	if(isset($form_data["scheduled_date"])) {
		$scheduled_date = date('Y-m-d H:i', strtotime(trim($form_data["scheduled_date"])));
	}

	if(isset($form_data["duration"])) {
		//TODO: format as an H:i time string
		$duration = trim($form_data["duration"]);
	}

	if(isset($scheduled_date) && isset($duration)) {
		//TODO: do some math and find the end time
		$end_time = 'some date';
	}

	//enter room request in db and get id
	$room_request_boolean = boolval($form_data["room_request_boolean"]);
	if($room_request_boolean) {
		$room_request_id = create_room_request();
	}

	//hosting organization

	$hosting_org_code = intval($form_data['hosting_org_code']);
	if($hosting_org_code === 1) {
		//require
		$wfc_org_id = parse_id($form_data['wfc_org_id'], 'wfc_org_id-');
		//set $host_name to wfc org name
	} else if (($hosting_org_code === 3) && $form_data['outside_org_id'] != '0') {
		//require
		$outside_org_id = parse_id($form_data['outside_org_id'], 'outside_org_id-');
		//set $host_name to outside org name
	} else if ($hosting_org_code === 3) {
		//require
		$outside_org_id = create_outside_org();
		//set $host_name to outside org name
	}

	//contact
	$contact_name = trim($form_data["contact_name"]);
	if(isset($form_data["contact_email"])) {
		$contact_email = trim($form_data["contact_email"]);
	}
	if(isset($form_data["contact_phone"])) {
		$contact_phone = trim($form_data["contact_phone"]);
	}

	//advocacy
	$advocacy_boolean = boolval($form_data["advocacy_boolean"]);

	//presenter
	$presenter_boolean = boolval($form_data["presenter_boolean"]);
	if($presenter_boolean) {
		$presenter_name = trim($form_data['presenter_name']);
		if(isset($form_data['presenter_link'])) {
			$presenter_link = trim($form_data['presenter_link']);
		}
		if(isset($form_data['presenter_bio'])) {
			$presenter_bio = trim($form_data['presenter_bio']);
		}
	}

	//location
	$on_campus_boolean = boolval(trim($form_data['on_campus_boolean']));
	if($on_campus_boolean) {
		//require
		$room_id = parse_id($form_data['on_campus_room_id'], 'room_id-');
		//set location address for calendar api through require from calendar/on_campus_location
		$location_address = get_on_campus_location($room_id);
		//accessible status for on campus room is retrieved through a join on the room id
		$accessible_status = NULL;
	} else {
		$outside_location_name = trim($form_data['outside_location_name']);
		$outside_location_address = trim($form_data['outside_location_address']);
		//for calendar api
		$location_address = $outside_location_address;
		if(isset($form_data['outside_location_link'])) {
			$outside_location_link = trim($form_data['outside_location_link']);
		}
		if(isset($form_data['outside_location_blurb'])) {
			$outside_location_blurb = trim($form_data['outside_location_blurb']);
		}
		//accessible status for outside location
		//require
		$accessible_status = parse_id($form_data['accessible_status'], 'accessible_status_id-');
	}

	//family-friendly & childcare
	$family_friendly_boolean = boolval($form_data['family_friendly_boolean']);

	$childcare_boolean = boolval($form_data['childcare_boolean']);

	//languages
	$language_boolean = boolval($form_data['language_boolean']);
	if($language_boolean) {
		$languages = get_languages();
	}

	if($form_data['hashtag']) {
		$hashtag = trim($form_data['hashtag']);
	}

	//create array to save to db from variables just created

	$table_name = 'events';
	$wpdb->insert(
		$table_name,
		array(
			'event_name' => $event_name,
			'short_note' => $short_note,
			'blurb' => $blurb,
			'scheduled_date' => $scheduled_date,
			'duration' => $duration,
			'room_request_id' => $room_request_id,
			'wfc_org_id' => $wfc_org_id,
			'outside_org_id' => $outside_org_id,
			'contact_name' => $contact_name,
			'contact_email' => $contact_email,
			'contact_phone' => $contact_phone,
			'advocacy_boolean' => $advocacy_boolean,
			'presenter_name' => $presenter_name,
			'presenter_link' => $presenter_link,
			'presenter_bio' => $presenter_bio,
			'room_id' => $room_id,
			'accessible_status' => $accessible_status,
			'outside_location_name' => $outside_location_name,
			'outside_location_address' => $outside_location_address,
			'outside_location_blurb' => $outside_location_blurb,
			'outside_location_link' => $outside_location_link,
			'family_friendly_boolean' => $family_friendly_boolean,
			'childcare_boolean' => $childcare_boolean,
			'languages' => $languages,
			'hashtag' => $hashtag
		)//,
		//array('%s', '%s', '%s') //data format, TODO: do i need this and why
	);



	if(isset($scheduled_time) && ($room_request_id === NULL)) {
		//require from calendar directory, make sure all these vars are set in the right place within this function
		//if room request, all events cal and space use cal will be set upon reservation completion
		//if no scheduled time but not room request, all events cal and (if applicable) space use cal will be set upon adding a time
		add_to_all_events_calendar($event_name, $event_description, $scheduled_date, $end_time, $host_name, $location_address);
	}
}

create_event();
