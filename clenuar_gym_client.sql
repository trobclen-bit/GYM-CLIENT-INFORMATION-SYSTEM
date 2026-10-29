

CREATE TABLE clients (
    client_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(60) NOT NULL,
    last_name VARCHAR(60) NOT NULL,
    gender VARCHAR(20),
    birth_date DATE,
    contact_number VARCHAR(30),
    address VARCHAR(150),
    email VARCHAR(100)
);
INSERT INTO clients (first_name, last_name, gender, birth_date, contact_number, address, email) VALUES ('Kevin', 'Santos', 'Male', '1996-05-10', '09123456789', 'Bogo City, Cebu', 'kevin@example.com');
