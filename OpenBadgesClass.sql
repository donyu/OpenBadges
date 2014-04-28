--
-- OpenBadges logging schema
-- Records relevant information regarding issuing of badges
--

CREATE TABLE IF NOT EXISTS /*_*/openbadges_class (
  obl_badge_id int NOT NULL PRIMARY KEY auto_increment,

  -- Name of the achievement
  obl_name varchar(64) NOT NULL,

  -- Description of the badge
  obl_description blob NOT NULL,

  -- Image of the badge
  obl_badge_image blob NOT NULL,

  -- Criteria for earning the badge; might be URL
  obl_criteria varchar(255) NOT NULL,

  -- Id of the issuer
  obl_issuer int NOT NULL,

  -- List of tags that describe the achievement
  obl_tags blob NOT NULL
) /*$wgDBTableOptions*/;

CREATE INDEX /*i*/obl_name ON /*_*/openbadges_class (obl_name);
