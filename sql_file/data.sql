CREATE TABLE admin (
    admin_id INT PRIMARY KEY,
    admin_name VARCHAR(50),
    admin_email VARCHAR(50),
    admin_password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE patient (
    patient_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_name VARCHAR(50),
    patient_gender VARCHAR(10),
    patient_phone BIGINT(10),
    patient_address VARCHAR(255),
    patient_email VARCHAR(50),
    patient_password VARCHAR(255)
);

CREATE TABLE nurse(
    nurse_id INT PRIMARY KEY AUTO_INCREMENT,
    nurse_name VARCHAR(50),
    nurse_gender VARCHAR(10),
    nurse_phone BIGINT(10),
    nurse_address VARCHAR(255),
    nurse_email VARCHAR(50),
    nurse_password VARCHAR(255),
    nurse_uid INT(7)
);

CREATE TABLE authentication (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    mobile_no INT(10) NOT NULL,
    otp VARCHAR(10) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE user (
    user_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(50),
    password VARCHAR(255),
    role INT(1),
    admin_id INT,
    patient_id INT,
    nurse_id INT,
    FOREIGN KEY (admin_id) REFERENCES admin(admin_id),
    FOREIGN KEY (patient_id) REFERENCES patient(patient_id),
    FOREIGN KEY (nurse_id) REFERENCES nurse(nurse_id)
);

CREATE TABLE pat_nur (
    patient_id INT(11),
    nurse_id INT(11),
    consultation_date DATE,
    FOREIGN KEY (patient_id) REFERENCES patient(patient_id),
    FOREIGN KEY (nurse_id) REFERENCES nurse(nurse_id)
);
INSERT INTO admin (admin_id, admin_name, admin_email, admin_password)
VALUES (1, 'roshan', 'roshan@gmail.com', '567');
