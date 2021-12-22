CREATE DATABASE seamail CHARSET=utf8mb4;
SET autocommit=0;
USE seamail;

CREATE TABLE users (
  id_user INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(128),
  profile_picture VARCHAR(255),
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
  id_auteur INT UNSIGNED NOT NULL,
  id_piece_jointe INT UNSIGNED NOT NULL,
  contenu VARCHAR(255),
  date_publication TIMESTAMP,
  CONSTRAINT fk_id_auteur
  FOREIGN KEY (id_auteur)
  REFERENCES users(id_user) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_id_piece_jointe
  FOREIGN KEY (id_piece_jointe)
  REFERENCES piecesjointes(id_piece_jointe) ON DELETE CASCADE ON UPDATE CASCADE)
  ENGINE InnoDB CHARSET utf8mb4;

  CREATE TABLE salons (
    id_salon INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom_salon VARCHAR(255),
    date_creation_salon TIMESTAMP,
    icone_salon VARCHAR(255),
    createur_salon INT UNSIGNED NOT NULL,
    CONSTRAINT fk_createur_salon
    FOREIGN KEY (createur_salon)
    REFERENCES users(id_user) ON DELETE CASCADE ON UPDATE CASCADE)
    ENGINE InnoDB CHARSET utf8mb4;

  CREATE TABLE membres_salons (
    id_salon INT UNSIGNED NOT NULL,
    id_membre INT UNSIGNED NOT NULL,
    CONSTRAINT fk_id_membre
    FOREIGN KEY (id_membre)
    REFERENCES users(id_user) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_id_salon
    FOREIGN KEY (id_salon)
    REFERENCES salons(id_salon) ON DELETE CASCADE ON UPDATE CASCADE)
    ENGINE InnoDB CHARSET utf8mb4;

  CREATE TABLE messages_salons (
    id_salon INT UNSIGNED NOT NULL,
    id_message INT UNSIGNED NOT NULL,
    CONSTRAINT fk_id_message
    FOREIGN KEY (id_message)
    REFERENCES messages(id_message) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_id_salon_msg
    FOREIGN KEY (id_salon)
    REFERENCES salons(id_salon) ON DELETE CASCADE ON UPDATE CASCADE)
    ENGINE InnoDB CHARSET utf8mb4;

    CREATE TABLE Erreur (
    id_error INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    erreur VARCHAR(255) UNIQUE)
    ENGINE InnoDB CHARSET utf8mb4;

    DELIMITER |
    CREATE TRIGGER before_update_userprofile BEFORE UPDATE
    ON users FOR EACH ROW
    BEGIN
        IF NEW.profile_picture IS NULL          
          THEN
            SET NEW.profile_picture = "img/profiles/default.png";
        END IF;
    END |
    DELIMITER ;

    DELIMITER |
    CREATE TRIGGER before_insert_user_picture BEFORE INSERT
    ON users FOR EACH ROW
    BEGIN
        IF NEW.profile_picture IS NULL          
          THEN
            SET NEW.profile_picture = "img/profiles/default.png";
        END IF;
    END |
    DELIMITER ;

    DELIMITER |
    CREATE TRIGGER before_update_salons BEFORE UPDATE
    ON salons FOR EACH ROW
    BEGIN
        IF NEW.icone_salon IS NULL          
          THEN
            SET NEW.icone_salon = "img/salons/default.png";
        END IF;
    END |
    DELIMITER ;

    DELIMITER |
    CREATE TRIGGER before_insert_salons BEFORE INSERT
    ON salons FOR EACH ROW
    BEGIN
        IF NEW.icone_salon IS NULL          
          THEN
            SET NEW.icone_salon = "img/salons/default.png";
        END IF;
    END |
    DELIMITER ;

    DELIMITER |
    CREATE TRIGGER before_update_user_rang BEFORE UPDATE
    ON users FOR EACH ROW
    BEGIN
        IF NEW.rang != "Administrateur"
        AND NEW.rang != "Membre"           
          THEN
            INSERT INTO Erreur (erreur) VALUES ("Erreur : le rang de l'utilisateur ne peut être que Administateur ou Membre");
        END IF;
    END |
    DELIMITER ;

    LOCK TABLES users WRITE;
    INSERT INTO users (username, profile_picture, mail, score, rang, password, date_creation_compte) VALUES ("ClaudeGodard", "img/profiles/default.png", "claude.godard@example.com", 0, "Administrateur", "6188c6eab8579cbbc37cfab16dfd26d2310a738fe9c5754e138f040e1f94003a", "2021-12-17 14:14:14");
    UNLOCK TABLES;

    LOCK TABLES salons WRITE;
    INSERT INTO salons (nom_salon, date_creation_salon, icone_salon, createur_salon) VALUES ("Général", "2021-12-17 14:14:14", "img/salons/default.png", 1);
    UNLOCK TABLES;

    LOCK TABLES membres_salons WRITE;
    INSERT INTO membres_salons (id_salon, id_membre) VALUES (1, 1);
    UNLOCK TABLES;
