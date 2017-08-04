<?php
/*
Plugin Name: Simple Events List
Description:
Version: 1
Author: sarah riehl & terry matula
Author URI: http://terrymatula.com & https://studioriehl.com
*/

//menu items
add_action('admin_menu', 'events_modifymenu');
function events_modifymenu()
{
    //this is the main item for the menu
    add_menu_page('Events', //page title
        'Events List', //menu title
        'edit_pages', //capabilities
        'events_list', //menu slug
        'events_list' //function
    );

    //this is a submenu
    add_submenu_page('events_list', //parent slug
        'Add New Event', //page title
        'Add New', //menu title
        'edit_pages', //capability
        'events_create', //menu slug
        'events_create'); //function

    //this submenu is HIDDEN, however, we need to add it anyways
    add_submenu_page(null, //parent slug
        'Update Event', //page title
        'Update', //menu title
        'edit_pages', //capability
        'events_update', //menu slug
        'events_update'); //function
}

// function next_sermon_shortcode()
// {
//     global $wpdb;
//     $nextSermon = $wpdb->get_row("SELECT * FROM sermons WHERE scheduled_for >= '" . date('Y-m-d') . "' ORDER BY scheduled_for ASC");
//     $html = '<div><h3>' . stripslashes($nextSermon->title) . '</h3>';
//     if(!empty($nextSermon->scheduled_for)) {
//         $html .=  '<h4>' . date('F d, Y', strtotime($nextSermon->scheduled_for)) . '</h4>';
//     }
//     $html .=  '<h4>' . $nextSermon->speakers . '</h4>';
//     $html .=  '<p>' . nl2br(stripslashes($nextSermon->description)) . '</p></div>';
//     return $html;
// }

$html = '';
$htmlContactContact = '';
$htmlPageSection = '';

function upcoming_events_shortcode()
{
    global $wpdbEvent;

		$index = 0;
		$colorIndex = 0;
		$color = '';
		$blue = 'rgba(131,163,198,0.68)';
		$orange = '#e0b65c';
		$yellow = '#edef56';
		$green = '#b8d897';
		$purple = 'rgba(111,97,150,0.54)';
		$red = '#e0847f';

    $rows = $wpdbEvent->get_results("SELECT * FROM events WHERE scheduled_date >= '" . date('Y-m-d') . "' AND start_hour >= '" . intval(date('H')) + 1 . "' ORDER BY scheduled_date ASC, start_hour ASC");

    foreach ($rows as $row) {
			$index++;
			if($index <= 6) {
				$colorIndex = $index;
			} else {
				for($i = 1; $i <= 6; $i++) {
					if(($index-$i)%6 == 0) {
						$colorIndex = $i;
					}
				}
			}
			switch($colorIndex) {
				case 1:
				 $color = $blue;
				 break;
				case 2:
					$color = $orange;
					break;
				case 3:
					$color = $yellow;
					break;
				case 4:
					$color = $green;
					break;
				case 5:
					$color = $purple;
					break;
				case 6:
					$color = $red;
					break;
				default:
					$color = '#fff';
			}
			$htmlPage .= '<div style="background-color: ' . $color . ';" class="et_pb_section et_pb_with_background et_pb_section_' . $index . 'et_section_regular"><div class="et_pb_row et_pb_row_' . $index . '"><div class="et_pb_column et_pb_column_4_4 et_pb_column_' . $index . '"><div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_' . $index . '">';
			//first line - date/time: event name - note
        $html .= '<h3>' . date('F d', strtotime($row->scheduled_date)) . ' ' . date('h:i a', strtotime($row->start_time)) . '-' . date('h:i a', strtotime($row->end_time)) . ':  <em>' . $row->event_name . '</em> - <span class="accent">' . $row->short_note . '</span></h3>';
			//second line: organized by org with link, dropdown available
				if($row->organization_link) {
					$html .= '<h4>Organized by <a style="text-decoration: underline;" target="_blank" href="' . $row->organization_link . '">' . $row->organization_name . '</a></h4>';
				} else {
					global $wpdbWfcOrg;
					$rowWfcOrg = $wpdbWfcOrg->get_results("SELECT * FROM wfc_orgs WHERE id = '" .  $row->wfc_org_id . "' LIMIT 1");
					$html .= '<h4>Organized by <a style="text-decoration: underline;" target="_blank" href="' . $rowWfcOrg->wfc_org_link . '">' . $rowWfcOrg->wfc_org_name . '</a></h4>';
				}
			//third line: OPTIONAL presented by person with OPTIONAL link
				if($row->presenter_link) {
					$html .= '<h4>Presented by <a style="text-decoration: underline;" target="_blank" href="' . $row->presenter_link . '">' . $row->presenter_name . '</a></h4>';
				} elseif($row->presenter_name) {
					$html .= '<h4>Presented by ' . $row->presenter_name . '</h4>';
				}
			//fourth line: happening at oncampus venue with link to page or offcampus venue with map link
				if($row->on_campus_boolean == '1') {
					global $wpdbRoom;
			    $rowRoom = $wpdbRoom->get_results("SELECT * FROM campus_rooms WHERE id = $row->on_campus_room_id LIMIT 1");
					$html .= '<h5><a style="text-decoration: underline;" href="/visit">On the Wildflower campus in' . $rowRoom->room_name . '</a></h5>';
				} else {
					$html .= '<h5>At <a style="text-decoration: underline;" target="_blank" a href="' . $row->map_url . '">' . $row->outside_venue . '</a></h5>';
				}

			//fifth line: blurb
				$html .= '<p>' . $row->blurb . '</p>';

			//sixth line: OPTIONAL learn more at link
				if($row->info_link) {
					$html .= '<h5>Learn more at ' . $row->info_link . '</h5>';
				}
			//seventh line: OPTIONAL childcare will be available

			if($row->childcare_boolean == '1') {
				$html .= '<h5>Complimentary childcare will be available</h5>';
			}

			//eighth line: OPTIONAL language or interpretation

			if($row->language_id !== null) {
				global $wpdbLanguage;
				$rowLanguage = $wpdbLanguage->get_results("SELECT * FROM languages WHERE id = $row->language_id LIMIT 1");
				$html .= '<h5>' . $rowLanguage->language_name . ' translation will be available</h5>';
			}

			//ninth line: accessibility

			if($row->accessibility_boolean == '1') {
				$html .= '<h5>This venue is accessible.</h5>';
			}

			//tenth line: contact person at contact info
			if($row->contact_email && $row->contact_phone) {
				$html .= '<h5><em>Contact ' . $row->contact_person . ' at <a target="_blank" href="mailto:' . $row->contact_email . '">' . $row->contact_email . '</a> or <a href="tel:+1"' . $row->contact_phone . '">' . $row->contact_phone . '</a> for more details.</em></h5>';
			} elseif($row->contact_email) {
				$html .= '<h5><em>Contact ' . $row->contact_person . ' at <a target="_blank" href="mailto:' . $row->contact_email . '">' . $row->contact_email . '</a> for more details.</em></h5>';
			} else {
				$html .= '<h5><em>Contact ' . $row->contact_person . ' at <a href="tel:+1"' . $row->contact_phone . '">' . $row->contact_phone . '</a> for more details.</em></h5>';
			}


			//eleventh line: OPTIONAL use hashtag hashtag

			if($row->hashtag) {
				$html .= '<h5>Use hashtag #' . $row->hashtag . ' in your social media posts.</h5>';
			}


			//twelfth: CHECKBOX - outside organization disclaimer and 501c3 status statement
        if($row->outside_org_boolean == '1') {
					$html .= '<h6><em>This event is not sponsored by Wildflower Church.  We are a 501(c)(3) organization and inclusion of this event in our calendar does not constitute an endorsement of a political candidate or policy position.  It is provided for information purposes only.  Please direct any legal questions to <a target="_blank" href="mailto:secretary@wildflowerchurch.org">secretary@wildflowerchurch.org</a></em></h6>';
				}

				$htmlContactContact .= $html;

				$htmlPageSection .= $html;
				$htmlPageSection .= '</div></div></div></div>';
				$htmlPage .= $htmlPageSection
    } //foreach close

    return $htmlPage;
}

function constant_contact_events_shortcode() {
	return $htmlConstantContact;
}

add_shortcode('upcoming_events', 'upcoming_events_shortcode');

add_shortcode('constant_contact_events', 'constant_contact_events_shortcode');

define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'events-list.php');
require_once(ROOTDIR . 'events-create.php');
require_once(ROOTDIR . 'events-update.php');
