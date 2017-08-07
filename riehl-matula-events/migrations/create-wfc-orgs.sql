USE wildflv8_ss_dbname532;

CREATE TABLE wfc_orgs(
	id INTEGER(10) AUTO_INCREMENT NOT NULL,
	wfc_org_name VARCHAR(50),
	wfc_org_link VARCHAR(75),
	wfc_org_email VARCHAR(50),
	PRIMARY KEY (id)
);

INSERT INTO wfc_orgs (wfc_org_name, wfc_org_link, wfc_org_email)
VALUES
('Adult Programs', 'https://wildflowerchurch.org/adult-religious-education', 'adultprograms@wildflowerchurch.org'),
("Children's Religious Education", 'https://wildflowerchurch.org/childrens-religious-education', 'dre@wildflowerchurch.org'),
('Youth Religious Education', 'https://wildflowerchurch.org/childrens-religious-education', 'youthre@wildflowerchurch.org')
('Worship Team', 'https://wildflowerchurch.org/worship', 'worship@wildflowerchurch.org'),
('Music Team', 'https://wildflowerchurch.org/worship/#music', 'music@wildflowerchurch.org'),
('Wildflower Austin Interfaith Team', 'https://wildflowerchurch.org/justice/#WAIT', 'interfaith@wildflowerchurch.org'),
('WildEarth Climate Action Team', 'https://wildflowerchurch.org/justice/#WildEarth', 'WildEarth@wildflowerchurch.org'),
('Justice Team', 'https://wildflowerchurch.org/justice/#justice', 'justice@wildflowerchurch.org'),
('Fun & Fellowship', 'https://wildflowerchurch.org/teams/#fellowship', 'fellowship@wildflowerchurch.org'),
('Pastoral Care Team', 'https://wildflowerchurch.org/teams/#care', 'caring@wildflowerchurch.org'),
('Membership Team', 'https://wildflowerchurch.org/join', 'membership@wildflowerchurch.org'),
('Hospitality Team', 'https://wildflowerchurch.org/teams/#hospitality', 'hospitality@wildflowerchurch.org'),
('Communications Team', 'https://wildflowerchurch.org/teams/#communications', 'communications@wildflowerchurch.org'),
('Right Relations Team', 'https://wildflowerchurch.org/teams/#rightrelations', 'rightrelations@wildflowerchurch.org'),
('Finance Team', 'https://wildflowerchurch.org/finance', 'finance@wildflowerchurch.org'),
('Stewardship Team', 'https://wildflowerchurch.org/giving/', 'stewardship@wildflowerchurch.org'),
('Facilities Team', 'https://wildflowerchurch.org/teams/#facilities', 'facilities@wildflowerchurch.org'),
('Personnel Team', 'https://wildflowerchurch.org/teams/#personnel', 'personnel@wildflowerchurch.org'),
('Endowment Committee', 'https://wildflowerchurch.org/teams/#endowment', 'endowment@wildflowerchurch.org'),
('Governance Committee', 'https://wildflowerchurch.org/teams/#governance', 'governance@wildflowerchurch.org'),
('Nominating Committee', 'https://wildflowerchurch.org/teams/#nominating', 'nominating@wildflowerchurch.org'),
('Wildflower Board', 'https://wildflowerchurch.org/board', 'board@wildflowerchurch.org')
;
