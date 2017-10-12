USE wildflv8_ss_dbname532;

CREATE TABLE accessibility_level(
	id INTEGER(10) AUTO_INCREMENT NOT NULL,
	description VARCHAR(250) NOT NULL,
	PRIMARY KEY (id)
);

** include unknown and not accessible, stairs, elevator, ramps, thresholds **
