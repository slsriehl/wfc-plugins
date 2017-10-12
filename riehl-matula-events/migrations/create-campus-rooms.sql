USE wildflv8_ss_dbname532;

CREATE TABLE campus_rooms(
	id INTEGER(10) AUTO_INCREMENT NOT NULL,
	room_name VARCHAR(50) NOT NULL,
	room_accessible BOOLEAN,
	accessibility_id INTEGER(10),
	PRIMARY KEY (id),
	FOREIGN KEY accessibility_id REFERENCES accessibility_level (id)
);

INSERT INTO campus_rooms (room_name)
VALUES
('Sanctuary'),
('Wildflower Community Room'),
('Classroom 1'),
('Classroom 2'),
('Faith Fellowship Hall'),
('Faith Parlor');
