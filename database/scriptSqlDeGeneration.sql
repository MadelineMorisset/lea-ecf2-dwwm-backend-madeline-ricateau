CREATE TABLE Admin_User(
   id_admin INT AUTO_INCREMENT,
   login_admin VARCHAR(20)  NOT NULL,
   password_admin VARCHAR(255)  NOT NULL,
   PRIMARY KEY(id_admin),
   UNIQUE(login_admin)
);

CREATE TABLE Link(
   id_link INT AUTO_INCREMENT,
   url_link VARCHAR(255)  NOT NULL,
   titre_link VARCHAR(110)  NOT NULL,
   description_link TEXT,
   date_link DATE,
   PRIMARY KEY(id_link)
);

CREATE TABLE Link_Comment(
   id_comment INT AUTO_INCREMENT,
   login_comment VARCHAR(20)  NOT NULL,
   commentaire VARCHAR(255)  NOT NULL,
   date_comment DATE,
   heure_comment TIME,
   id_link INT NOT NULL,
   PRIMARY KEY(id_comment),
   FOREIGN KEY(id_link) REFERENCES Link(id_link)
);
