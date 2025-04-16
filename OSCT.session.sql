DESCRIBE documents;
SELECT * FROM documents;
SELECT * FROM documents WHERE user_id = 'J3QZD3TA';
TRUNCATE TABLE documents;
DESCRIBE patients;
DROP TABLE IF EXISTS schedules;
ALTER TABLE documents DROP FOREIGN KEY documents_user_id_foreign;
SHOW CREATE TABLE documents;

show tables;
DESCRIBE admins;
DESCRIBE patients;
DESCRIBE personnel;
DESCRIBE lab_results;
DESCRIBE measurements;
DESCRIBE schedule;
SELECT * FROM schedule;
SELECT * FROM measurements WHERE id = 1;
SELECT * FROM measurements;

SELECT * FROM patients;

SELECT * FROM admins;
SELECT * FROM personnel;
SELECT * FROM patients;

SELECT * FROM admins WHERE username = 'admin';
UPDATE admins 
SET password = '$2y$12$dWAlLXjn3dU3TdCbYj/xeON4Mpy4FiarM8ZiYTRRBZHCyfiDjF32W' 
WHERE username = 'admin';
UPDATE personnel 
SET password = '$2y$12$5yHVkuefKgv7g2tkNRZZP.etbi.3YCboP11DcplEkfY0RX8G6VAC.' 
WHERE username = 'personnel';
SELECT password FROM admins WHERE username = 'admin';
SELECT username, password FROM admins WHERE username = 'admin';
DELETE FROM admins WHERE username = 'admin';
TRUNCATE TABLE sessions;
ALTER TABLE schedule
  CHANGE `NOMBRE DE LA ESCUELA` school_name VARCHAR(255),
  CHANGE `TOTAL DE ALUMNOS` total_students INT,
  CHANGE `MUNICIPIO` municipality VARCHAR(255),
  CHANGE `LOCALIDAD` locality VARCHAR(255),
  CHANGE `DOMICILIO` address VARCHAR(255),
  CHANGE `NIVEL` level VARCHAR(255),
  CHANGE `TURNO` shift VARCHAR(255),
  CHANGE `CCT` cct VARCHAR(255),
  CHANGE `FECHA` date DATE;

TRUNCATE TABLE schedule;

