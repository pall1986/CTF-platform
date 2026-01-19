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

INSERT INTO challenges (title, slug, description, points, flag, active)
VALUES (
    'RSA Breaker',
    'rsa_corrotto',
    'Decifra il seguente messaggio cifrato con RSA: 1660585305757591176224234804801 (usa n = 2000000000000000000000000000002 e e = 65537)',
    20,
    'FLAG{RSA_CORROTTO}',
    1
);

