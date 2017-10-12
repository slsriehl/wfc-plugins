USE wildflv8_ss_dbname532;

CREATE TABLE contacts(
	id INTEGER(10) AUTO_INCREMENT NOT NULL,
	contact_name VARCHAR(100) NOT NULL,
	contact_email VARCHAR(100) NOT NULL,
	contact_phone VARCHAR(20),
	PRIMARY KEY (id)
);
