DROP DATABASE IF EXISTS projet;
CREATE DATABASE projet charset=utf8;

USE projet;

DROP TABLE IF EXISTS Language;
CREATE TABLE Language(
    language_id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    language_name VARCHAR(256),
    language_part VARCHAR(256)
);

INSERT INTO Language(language_name,language_part) VALUES ("PHP","Back-End");
INSERT INTO Language(language_name,language_part) VALUES ("SQL","Back-End");
INSERT INTO Language(language_name,language_part) VALUES ("MySQL","Back-End");
INSERT INTO Language(language_name,language_part) VALUES ("HTML","Front-End");
INSERT INTO Language(language_name,language_part) VALUES ("CSS","Front-End");
INSERT INTO Language(language_name,language_part) VALUES ("JS","Front-End");