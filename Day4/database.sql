DROP DATABASE IF EXISTS iti_sm_php_g2_2026;
CREATE DATABASE iti_sm_php_g2_2026;
USE iti_sm_php_g2_2026;

CREATE TABLE users (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    name     VARCHAR(50)  NOT NULL,
    email    VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE departments (
    dnum           INT AUTO_INCREMENT PRIMARY KEY,
    dname          VARCHAR(50) NOT NULL UNIQUE,
    mgr_ssn        INT         NULL,
    mgr_start_date DATE        NULL
);

CREATE TABLE employees (
    ssn      INT AUTO_INCREMENT PRIMARY KEY,
    fname    VARCHAR(50)  NOT NULL,
    lname    VARCHAR(50)  NOT NULL,
    bdate    DATE         NULL,
    address  VARCHAR(150) NULL,
    gender   ENUM('male','female') NULL,
    salary   DECIMAL(10,2) NULL,
    dnum     INT          NULL,
    FOREIGN KEY (dnum) REFERENCES departments(dnum) ON DELETE SET NULL
);

CREATE TABLE projects (
    pnumber   INT AUTO_INCREMENT PRIMARY KEY,
    pname     VARCHAR(50) NOT NULL UNIQUE,
    plocation VARCHAR(50) NULL,
    dnum      INT         NULL,
    FOREIGN KEY (dnum) REFERENCES departments(dnum) ON DELETE SET NULL
);

INSERT INTO departments (dname, mgr_ssn, mgr_start_date) VALUES
('HR',        1, '2020-01-01'),
('IT',        2, '2021-03-15'),
('Accounting',3, '2019-09-01');

INSERT INTO employees (fname, lname, bdate, address, gender, salary, dnum) VALUES
('basmala',  'ahmed',   '2000-05-10', 'cairo',    'female', 5000.00, 2),
('mohammed', 'ali',     '1998-11-02', 'menoufia', 'male',   7000.00, 2),
('habiba',   'mahmoud', '2001-02-20', 'sadat',    'female', 4500.00, 1),
('nada',     'sameh',   '1997-07-07', 'alex',     'female', 6500.00, 3);

INSERT INTO projects (pname, plocation, dnum) VALUES
('AL Rabwah',  'Cairo', 2),
('Product X',  'Alex',  2),
('Newbenefits','Cairo', 1);

INSERT INTO users (name, email, password) VALUES
('esraa', 'esraa@iti.com', '$2y$10$MNpzA9yh.sdtPQDwPanEF.hBaanNQJJpKXBCtK97HC2Rjs9i0DjTK');
