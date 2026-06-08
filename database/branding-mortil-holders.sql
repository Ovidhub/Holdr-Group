-- Apply Mortil Holders branding to the production database.
-- Run once against the live DB:  mysql -u <user> -p <database> < database/branding-mortil-holders.sql
-- (Or set these via Admin -> Settings -> Website Information, which is the normal workflow.)

UPDATE settings SET
  site_name     = 'Mortil Holders',
  site_title    = 'Welcome to Mortil Holders',
  site_address  = 'https://mortilholders.online',
  contact_email = 'info@mortilholders.online',
  emailfrom     = 'info@mortilholders.online',
  emailfromname = 'Mortil Holders',
  keywords      = 'Mortil Holders, online banking, digital banking, mortilholders.online',
  logo          = 'photos/mortil-logo.svg',
  favicon       = 'photos/mortil-icon.svg'
WHERE id = 1;
