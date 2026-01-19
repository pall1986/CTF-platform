CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    score INT DEFAULT 0
);





CREATE TABLE challenges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    slug VARCHAR(50) NOT NULL UNIQUE,
    description TEXT,
    points INT DEFAULT 0,
    flag VARCHAR(255) NOT NULL,
    active TINYINT(1) DEFAULT 1
);

CREATE TABLE solves ( id INT AUTO_INCREMENT PRIMARY KEY, user_id INT, challenge_id INT, solved_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, UNIQUE(user_id, challenge_id) );
INSERT INTO challenges (title, slug, description, points, flag)
VALUES (
    'Caesar Breaker',
    'caesar',
    'Decifra il messaggio cifrato con Cesare (+3)',
    10,
    'FLAG{CAESAR_E_AMICO}'
);
INSERT INTO challenges (title, slug, description, points, flag, active)
VALUES (
    'RSA Breaker',
    'rsa_corrotto',
    'Decifra il seguente messaggio cifrato con RSA: 1660585305757591176224234804801 (usa n = 2000000000000000000000000000002 e e = 65537)',
    20,
    'FLAG{RSA_CORROTTO}',
    1
);
INSERT INTO challenges
(title, slug, description, points, flag, active)
VALUES (
    'Robots Don’t Keep Secrets',
    'robots',
    'Trova la pagina nascosta usando robots.txt.',
    10,
    'FLAG{ROBOTS_NON_PROTEGGONO_NULLA}',
    1
);
