CREATE DATABASE survey_db;

USE survey_db;

CREATE TABLE survey_responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    email VARCHAR(100),
    date_of_birth DATE,
    contact_number VARCHAR(20),
    favorite_food VARCHAR(50),
    watch_movies INT,
    listen_radio INT,
    eat_out INT,
    watch_tv INT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
