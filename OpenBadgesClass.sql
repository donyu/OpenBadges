--
-- OpenBadges logging schema
-- Records relevant information regarding issuing of badges
--

CREATE TABLE IF NOT EXISTS /*_*/openbadges_class (
    obl_badge_id int NOT NULL PRIMARY KEY auto_increment, 			-- unique id 
	obl_name varchar(64) NOT NULL, 									-- name of the achievement 
	obl_description blob NOT NULL, 									-- description of the badge
	obl_badge_image blob NOT NULL, 									-- image of the badge 
	obl_criteria varchar(255) NOT NULL, 							-- criteria for earning the badge; might be URL
	obl_issuer int NOT NULL, 										-- id of the issuer 
	obl_tags blob NOT NULL											-- list of tags that describe the achievement
)/*$wgDBTableOptions*/;
