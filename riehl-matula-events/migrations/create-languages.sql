USE wildflv8_ss_dbname532;

CREATE TABLE languages(
	id INTEGER(10) AUTO_INCREMENT NOT NULL,
	language_name VARCHAR(25),
	PRIMARY KEY (id)
);

INSERT INTO languages(language_name)
VALUES
('Spanish'),
('American Sign Language');
