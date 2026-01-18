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