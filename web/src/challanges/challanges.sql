USE ctf_platform;

INSERT INTO challenges (title, slug, description, points, flag, active)
VALUES (
    'Caesar Breaker',
    'caesar',
    'Un messaggio è stato cifrato con il cifrario di Cesare (+3). Decifra il testo e trova la flag.',
    10,
    'FLAG{CAESAR_E_AMICO}',
    1
);
