DESCRIBE documents;
DESCRIBE patients;
DROP TABLE IF EXISTS patients;
ALTER TABLE documents DROP FOREIGN KEY documents_user_id_foreign;
SHOW CREATE TABLE documents;

show tables;
DESCRIBE admins;
DESCRIBE patients;
DESCRIBE personnel;
SELECT * FROM admins;
SELECT * FROM personnel;
SELECT * FROM patients;

SELECT * FROM admins WHERE username = 'admin';
UPDATE admins 
SET password = '$2y$12$dWAlLXjn3dU3TdCbYj/xeON4Mpy4FiarM8ZiYTRRBZHCyfiDjF32W' 
WHERE username = 'admin';
SELECT password FROM admins WHERE username = 'admin';
SELECT username, password FROM admins WHERE username = 'admin';
DELETE FROM admins WHERE username = 'admin';
TRUNCATE TABLE sessions;
