CREATE DATABASE seamail CHARSET=utf8mb4;

USE seamail;

CREATE TABLE users (
  id_user INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(128),
  mail VARCHAR(128),
  score INT UNSIGNED,
  rang VARCHAR(128),
  password VARCHAR(255),
  date_creation_compte TIMESTAMP)
  ENGINE InnoDB CHARSET utf8mb4;

CREATE TABLE piecesjointes (
  id_piece_jointe INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  lien_piece_jointe VARCHAR(255))
  ENGINE InnoDB CHARSET utf8mb4;

CREATE TABLE messages (
  id_message INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  id_expediteur INT UNSIGNED NOT NULL,
  id_destinataire INT UNSIGNED NOT NULL,
  id_piece_jointe INT UNSIGNED NOT NULL,
  contenu VARCHAR(255),
  date_publication TIMESTAMP,
  CONSTRAINT fk_id_expediteur
  FOREIGN KEY (id_expediteur)
  REFERENCES users(id_user) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_id_destinataire
  FOREIGN KEY (id_destinataire)
  REFERENCES users(id_user) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_id_piece_jointe
  FOREIGN KEY (id_piece_jointe)
  REFERENCES piecesjointes(id_piece_jointe) ON DELETE CASCADE ON UPDATE CASCADE)
  ENGINE InnoDB CHARSET utf8mb4;