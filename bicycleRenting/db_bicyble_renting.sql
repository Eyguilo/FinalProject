DROP DATABASE IF EXISTS db_bicycle_renting;
CREATE DATABASE db_bicycle_renting;
USE db_bicycle_renting;

CREATE TABLE T_Clients (
    id_client INT(5) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    postal_code INT(5)
);

CREATE TABLE T_Users (
    id_user VARCHAR(7) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    key_user VARCHAR(255) NOT NULL,
    profile_user VARCHAR(255) NOT NULL
);

CREATE TABLE T_Brands (
    id_brand INT(5) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL
);

CREATE TABLE T_Size (
    id_size INT(5) PRIMARY KEY AUTO_INCREMENT,
    size_cm INT(5) NOT NULL
);

CREATE TABLE T_Models (
    id_model INT(5) PRIMARY KEY AUTO_INCREMENT,
    id_brand INT(5) NOT NULL,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_brand)
        REFERENCES T_Brands (id_brand)
);

CREATE TABLE T_Bicycles (
    id_bicycle INT(5) PRIMARY KEY AUTO_INCREMENT,
    id_brand INT(5) NOT NULL,
    id_model INT(5) NOT NULL,
    id_size INT(5) NOT NULL,
    color VARCHAR(255),
    rental_price_hour DECIMAL(6 , 2 ) NOT NULL,
    available TINYINT(1) NOT NULL DEFAULT 1,
    FOREIGN KEY (id_model)
        REFERENCES T_Models (id_model),
    FOREIGN KEY (id_brand)
        REFERENCES T_Models (id_brand),
    FOREIGN KEY (id_size)
        REFERENCES T_Size (id_size)
);

CREATE TABLE T_Reservations (
    id_reservation INT(5) PRIMARY KEY AUTO_INCREMENT,
    id_client INT(5) NOT NULL,
    id_user VARCHAR(7) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    id_bicycle_1 INT(5) NOT NULL,
    id_bicycle_2 INT(5),
    id_bicycle_3 INT(5),
    id_bicycle_4 INT(5),
    reservation_date DATETIME NOT NULL DEFAULT NOW(),
	cancelled TINYINT(1) NOT NULL DEFAULT 0,
    reservation_cancelled_date DATETIME,
    FOREIGN KEY (id_client)
        REFERENCES T_Clients (id_client),
    FOREIGN KEY (id_user)
        REFERENCES T_Users (id_user),
    FOREIGN KEY (id_bicycle_1)
        REFERENCES T_Bicycles (id_bicycle),
    FOREIGN KEY (id_bicycle_2)
        REFERENCES T_Bicycles (id_bicycle),
    FOREIGN KEY (id_bicycle_3)
        REFERENCES T_Bicycles (id_bicycle),
    FOREIGN KEY (id_bicycle_4)
        REFERENCES T_Bicycles (id_bicycle)
);

CREATE TABLE T_Invoices (
    id_invoice INT PRIMARY KEY AUTO_INCREMENT,
    id_reservation INT NOT NULL,
    total_price DECIMAL(6 , 2 ) NOT NULL,
    issue_date DATETIME NOT NULL DEFAULT NOW(),
    paid TINYINT(1) NOT NULL DEFAULT 0,
    FOREIGN KEY (id_reservation)
        REFERENCES T_Reservations (id_reservation)
);

INSERT INTO T_Clients (name, last_name, email, phone, address, postal_code) VALUES
('John', 'Doe', 'johndoe@example.com', '123-456-789', '123 Main St.', 56743),
('Jane', 'Doe', 'janedoe@example.com', '987-654-321', '456 Oak St.', 56743),
('Bob', 'Smith', 'bobsmith@example.com', '555-555-555', '789 Elm St.', 56743),
('Alice', 'Johnson', 'alicejohnson@example.com', '111-111-111', '234 Maple St.', 56743),
('Mark', 'Davis', 'markdavis@example.com', '222-222-222', '567 Pine St.', 56743),
('Emily', 'Wilson', 'emilywilson@example.com', '333-333-333', '890 Cedar St.', 56743),
('David', 'Lee', 'davidlee@example.com', '444-444-444', '1234 Oakwood Ave.', 56743),
('Sarah', 'Kim', 'sarahkim@example.com', '777-777-777', '5678 Maplewood Blvd.', 56743),
('Michael', 'Brown', 'michaelbrown@example.com', '888-888-888', '9101 Elmwood Ln.', 56743),
('Jennifer', 'Smith', 'jennifersmith@example.com', '999-999-999', '2345 Pinewood Dr.', 56743),
('Alex', 'Johnson', 'alexjohnson@example.com', '111-222-333', '123 Elm St.', 56743),
('Jessica', 'Davis', 'jessicadavis@example.com', '444-555-666', '456 Oak St.', 56743),
('Ryan', 'Wilson', 'ryanwilson@example.com', '777-888-999', '789 Maple St.', 56743),
('Laura', 'Thomas', 'laurathomas@example.com', '111-222-333', '234 Pine St.', 56743),
('Steven', 'Anderson', 'stevenanderson@example.com', '444-555-666', '567 Cedar St.', 56743),
('Rebecca', 'Clark', 'rebeccaclark@example.com', '777-888-999', '890 Oakwood Ave.', 56743),
('Daniel', 'Taylor', 'danieltaylor@example.com', '111-222-333', '1234 Maplewood Blvd.', 56743),
('Samantha', 'Harris', 'samanthaharris@example.com', '444-555-666', '5678 Elmwood Ln.', 56743),
('Matthew', 'Walker', 'matthewwalker@example.com', '777-888-999', '9101 Pinewood Dr.', 56743),
('Stephanie', 'Turner', 'stephanieturner@example.com', '111-222-333', '2345 Oak St.', 56743),
('Andrew', 'Parker', 'andrewparker@example.com', '444-555-666', '123 Main St.', 56743),
('Michelle', 'White', 'michellewhite@example.com', '777-888-999', '456 Oak St.', 56743),
('Jonathan', 'Carter', 'jonathancarter@example.com', '111-222-333', '789 Maple St.', 56743),
('Lauren', 'Baker', 'laurenbaker@example.com', '444-555-666', '234 Pine St.', 56743),
('Kevin', 'Cook', 'kevincook@example.com', '777-888-999', '567 Cedar St.', 56743),
('Ashley', 'Green', 'ashleygreen@example.com', '111-222-333', '890 Oakwood Ave.', 56743),
('Christopher', 'Ross', 'christopherross@example.com', '444-555-666', '1234 Maplewood Blvd.', 56743),
('Amanda', 'Morgan', 'amandamorgan@example.com', '777-888-999', '5678 Elmwood Ln.', 56743),
('Nicholas', 'Howard', 'nicholashoward@example.com', '111-222-333', '9101 Pinewood Dr.', 56743),
('Heather', 'Phillips', 'heatherphillips@example.com', '444-555-666', '2345 Oak St.', 56743);

INSERT INTO T_Brands (name, description)
VALUES ('Trek' ,'Marca estadounidense de bicicletas conocida por su tecnología innovadora y diseños de alta calidad'), 
('Specialized', 'Marca estadounidense de bicicletas especializada en bicicletas de carretera y montaña de alta gama'), 
('Giant', 'Marca taiwanesa de bicicletas con una amplia variedad de modelos y precios para ciclistas de todos los niveles'), 
('Cannondale', 'Marca estadounidense de bicicletas conocida por sus diseños innovadores y tecnología avanzada');

INSERT INTO T_Models (id_brand, name, description)
VALUES (1, 'X-Caliber', 'Una bicicleta de montaña resistente y ágil para todo tipo de terrenos'), 
(1, 'Fuel EX', 'Una bicicleta de trail de doble suspensión diseñada para recorrer senderos técnicos con confianza y velocidad'), 
(2, 'Roubaix', 'Una bicicleta de carretera cómoda y rápida para largas distancias y terrenos variados'), 
(2, 'Diverge', 'Una bicicleta de aventura versátil que puede recorrer caminos de grava, terrenos escarpados y carreteras'),
(3, 'Defy', 'Una bicicleta de carretera de resistencia que ofrece una conducción cómoda y estable durante largas distancias'), 
(3, 'TCR', 'Una bicicleta de carretera de alta gama para competiciones y carreras'), 
(4, 'Topstone', 'Una bicicleta de grava de alto rendimiento con suspensión que ofrece una conducción cómoda y estable en terrenos difíciles'), 
(4, 'Synapse', 'Una bicicleta de carretera versátil y cómoda que ofrece un rendimiento de alta calidad para todo tipo de ciclistas');
       
INSERT INTO T_Size (size_cm)
SELECT size FROM
     (SELECT '150' AS size UNION ALL SELECT '160'
      UNION ALL SELECT '170' UNION ALL SELECT '180'
      UNION ALL SELECT '190' UNION ALL SELECT '200') s;



INSERT INTO T_Bicycles (id_brand, id_model, id_size, color, rental_price_hour)
SELECT b.id_brand, m.id_model, s.id_size, c.color,
       CASE
         WHEN b.name = 'Trek' THEN 100
         WHEN b.name = 'Specialized' THEN 120
         WHEN b.name = 'Giant' THEN 90
         WHEN b.name = 'Cannondale' THEN 80
         ELSE 0
       END * 
       CASE
         WHEN m.name LIKE '%Mountain%' THEN 1.35
         WHEN m.name LIKE '%Road%' THEN 1.45
         WHEN m.name LIKE '%City%' THEN 1.2
         WHEN m.name LIKE '%Electric%' THEN 1.25
         ELSE 1
       END *
       CASE
         WHEN s.size_cm > 150 AND s.size_cm % 10 = 0 THEN 1.03
         ELSE 1
       END AS price
FROM T_Brands b, T_Models m, T_Size s, 
     (SELECT 'Blue' AS color UNION ALL SELECT 'Black' UNION ALL SELECT 'White'
      UNION ALL SELECT 'Green' UNION ALL SELECT 'Grey') c
ORDER BY RAND()
LIMIT 200;
