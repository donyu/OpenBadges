--
-- OpenBadges logging schema
-- Records relevant information regarding issuing of badges
--

CREATE TABLE /*_*/openbadges_assertion (
  obl_id int NOT NULL PRIMARY KEY auto_increment,

  -- Timestamp
  obl_timestamp binary(14) NOT NULL,

  -- User id of the receiver
  obl_receiver varchar(255) NOT NULL,

  -- URL of the badge for the receiver
  obl_badge_id int NOT NULL REFERENCES openbadges_class(obl_badge_id),

  -- Image of the badge
  obl_badge_title varchar(255) REFERENCES page(page_title),

  -- Criteria for receiving the badge, if any
  obl_badge_evidence varchar(255) NOT NULL,

  -- Expiration of the badge, if any
  obl_expiration binary(14)
) /*wgDBTableOptions*/;

CREATE INDEX /*i*/obl_timestamp ON /*_*/openbadges_assertion (obl_timestamp);
CREATE INDEX /*i*/obl_receiver ON /*_*/openbadges_assertion (obl_receiver);
