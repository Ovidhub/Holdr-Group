-- Apply Orvatio Holders branding to the production database.
-- Run once against the live DB:  mysql -u <user> -p <database> < database/branding-mortil-holders.sql
-- (Or set these via Admin -> Settings -> Website Information, which is the normal workflow.)

UPDATE settings SET
  site_name     = 'Orvatio Holders',
  site_title    = 'Welcome to Orvatio Holders',
  site_address  = 'https://orvatioholders.online',
  contact_email = 'info@orvatioholders.online',
  emailfrom     = 'info@orvatioholders.online',
  emailfromname = 'Orvatio Holders',
  keywords      = 'Orvatio Holders, online banking, digital banking, orvatioholders.online',
  logo          = 'photos/orvatio-logo.svg',
  favicon       = 'photos/orvatio-icon.svg'
WHERE id = 1;
