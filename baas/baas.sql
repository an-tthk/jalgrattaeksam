CREATE TABLE jalgrattaeksam(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	eesnimi VARCHAR(30),
	perekonnanimi VARCHAR(30),
	teooriatulemus INT DEFAULT -1,
	slaalom INT DEFAULT -1,
	ringtee INT DEFAULT -1,
	t2nav INT DEFAULT -1,
	luba INT DEFAULT -1
);

INSERT INTO jalgrattaeksam (eesnimi, perekonnanimi)
VALUES
	('Juku', 'Juurikas'),
	('Kati', 'Tamm'),
	('Mati', 'Kask');

UPDATE jalgrattaeksam SET teooriatulemus = 9 WHERE id = 1;
UPDATE jalgrattaeksam SET teooriatulemus = 10, slaalom = 1, ringtee = 1, t2nav = 1, luba = 1 WHERE id = 2;
UPDATE jalgrattaeksam SET teooriatulemus = 10 WHERE id = 3;
