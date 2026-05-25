CREATE DATABASE IF NOT EXISTS ppcc_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ppcc_db;

DROP TABLE IF EXISTS gallery;
DROP TABLE IF EXISTS events;
DROP TABLE IF EXISTS announcements;
DROP TABLE IF EXISTS sunday_services;
DROP TABLE IF EXISTS hero_slides;
DROP TABLE IF EXISTS site_settings;
DROP TABLE IF EXISTS admins;

CREATE TABLE admins (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(60) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE site_settings (
  setting_key VARCHAR(80) PRIMARY KEY,
  setting_value TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE hero_slides (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  tag VARCHAR(120) DEFAULT NULL,
  title VARCHAR(180) NOT NULL,
  subtitle TEXT DEFAULT NULL,
  button_label VARCHAR(80) DEFAULT NULL,
  button_link VARCHAR(160) DEFAULT '#sunday',
  image_url VARCHAR(255) DEFAULT NULL,
  sort_order INT NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE sunday_services (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(160) NOT NULL,
  schedule_note VARCHAR(120) NOT NULL,
  service_time VARCHAR(120) NOT NULL,
  location_name VARCHAR(160) NOT NULL,
  address VARCHAR(255) NOT NULL,
  speaker VARCHAR(160) DEFAULT NULL,
  topic VARCHAR(180) DEFAULT NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE announcements (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(180) NOT NULL,
  body TEXT NOT NULL,
  announce_date DATE DEFAULT NULL,
  priority ENUM('Normal','Important','Urgent') NOT NULL DEFAULT 'Normal',
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE events (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(180) NOT NULL,
  event_type ENUM('worship','community','outreach','youth','other') NOT NULL DEFAULT 'community',
  event_date DATE NOT NULL,
  event_time TIME DEFAULT NULL,
  location VARCHAR(180) DEFAULT NULL,
  description TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE gallery (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  caption VARCHAR(180) NOT NULL,
  category ENUM('worship','feeding','fellowship','youth','outreach') NOT NULL DEFAULT 'worship',
  image_path VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO admins (username, password_hash) VALUES
('admin', '$2y$10$nzhqTGTvmd8DwhN.XRHVlOQCCR7HqAEF/vJGe52uMWuNIIEQ.dgvu');

INSERT INTO site_settings (setting_key, setting_value) VALUES
('church_name', 'Pao-pao Community Church'),
('tagline', 'Rooted in Faith, Growing in Love'),
('about_title', 'Rooted in Faith, Growing in Love'),
('about_body', 'Pao-pao Community Church is a Christ-centered family committed to worship, discipleship, compassion, and service. We gather to encourage one another, serve our neighbors, and share the hope of Jesus with our community.'),
('contact_address', 'Pao-pao, Masbate, Philippines'),
('contact_phone', '+63 900 000 0000'),
('contact_email', 'hello@ppcc.local'),
('facebook_url', '#');

INSERT INTO hero_slides (tag, title, subtitle, button_label, button_link, image_url, sort_order) VALUES
('Welcome Home', 'You Are Welcome Here', 'Join a caring church family where faith grows through worship, prayer, service, and genuine community.', 'Join Us Sunday', '#sunday', 'https://images.unsplash.com/photo-1507692049790-de58290a4334?auto=format&fit=crop&w=1600&q=80', 1),
('Community Outreach', 'Serving With Love', 'From fellowship gatherings to feeding programs, PPCC exists to bless our neighbors with compassion and hope.', 'See Events', '#events', 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=1600&q=80', 2);

INSERT INTO sunday_services (title, schedule_note, service_time, location_name, address, speaker, topic) VALUES
('Sunday Morning Worship', 'Every Sunday', '8:00 AM & 10:00 AM', 'PPCC Main Sanctuary', 'Pao-pao, Masbate, Philippines', 'PPCC Pastoral Team', 'Rooted in Faith, Growing in Love');

INSERT INTO announcements (title, body, announce_date, priority) VALUES
('Bring a Friend Sunday', 'Invite a friend or family member to worship with us this Sunday.', CURDATE(), 'Important');

INSERT INTO events (name, event_type, event_date, event_time, location, description) VALUES
('Sunday Worship Service', 'worship', DATE_ADD(CURDATE(), INTERVAL 6 DAY), '08:00:00', 'PPCC Main Sanctuary', 'Weekly worship gathering.'),
('Community Feeding Program', 'outreach', DATE_ADD(CURDATE(), INTERVAL 14 DAY), '09:00:00', 'Pao-pao Covered Court', 'Serving meals and prayer for families in the community.');
