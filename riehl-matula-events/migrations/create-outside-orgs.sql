USE wildflv8_ss_dbname532;

CREATE TABLE outside_orgs(
	id INTEGER(10) AUTO_INCREMENT NOT NULL,
	org_name VARCHAR(50) NOT NULL,
	org_website_link VARCHAR(250),
	org_social_link VARCHAR(250),
	contact_name VARCHAR(50),
	contact_email VARCHAR(100),
	contact_phone VARCHAR(20),
	PRIMARY KEY (id)
);
