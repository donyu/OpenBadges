--
-- OpenBadges logging schema
-- Records relevant information regarding issuing of badges
--

CREATE TABLE /*_*/openbadges_assertion (
	obl_id int NOT NULL PRIMARY KEY auto_increment,									-- unique id
	obl_timestamp binary(14) NOT NULL,              								-- timestamp
    obl_receiver int NOT NULL,                  									-- user id of the receiver
	obl_badge_id int NOT NULL REFERENCES openbadges_class(obl_badge_id),			-- url of the badge for the receiver
	obl_badge_title varchar(255) REFERENCES page(page_title), 						-- image of the badge
	obl_badge_evidence varchar(255) NOT NULL, 										-- criteria for receiving the badge 
	obl_expiration binary(14)														-- expiration of the badge if any
)

CREATE INDEX /*i*/obl_timestamp ON /*_*/openbadges_assertion (obl_timestamp);
CREATE INDEX /*i*/obl_receiver ON /*_*/openbadges_assertion (obl_receiver);
