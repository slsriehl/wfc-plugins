
USE wildflv8_ss_dbname532;

DROP TABLE events;

CREATE TABLE events(
	id INTEGER(10) AUTO_INCREMENT NOT NULL,
	event_name VARCHAR(250) NOT NULL,
	** datetime ** scheduled_date DATETIME,
	** remove ** start_time ,
	** remove ** end_time ,
	** datetime ** duration DATETIME,
	** remove ** start_hour ,
	short_note VARCHAR(500),
	blurb TEXT NOT NULL,
	organization_name VARCHAR(250) NOT NULL,
	organization_link VARCHAR(500),
	hosting_org_code INTEGER(3) NOT NULL,
	wfc_org_id INTEGER(10),
	presenter_name VARCHAR(250),
	presenter_link VARCHAR(500),
	on_campus_boolean TINYINT(1) NOT NULL,
	on_campus_room_id INTEGER(3),
	outside_venue VARCHAR(250),
	map_url VARCHAR(500),
	info_link VARCHAR(500),
	family_friendly_boolean TINYINT(1) NOT NULL,
	childcare_boolean TINYINT(1),
	language_id INTEGER(10),
	accessibility_id INTEGER(10) NOT NULL,
	contact_id INTEGER(10),
	contact_person VARCHAR(100),
	contact_email VARCHAR(100),
	contact_phone VARCHAR(20),
	hashtag VARCHAR(100),
	created_at TIMESTAMP NOT NULL,
	updated_at TIMESTAMP NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (wfc_org_id) REFERENCES wfc_orgs (id),
	FOREIGN KEY (language_id) REFERENCES languages (id),
	FOREIGN KEY (contact_id) REFERENCES contacts (id),
	FOREIGN KEY (accessibility_id) REFERENCES accessibility_levels (id)
);
