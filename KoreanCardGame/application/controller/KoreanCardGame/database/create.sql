# DROP DATABASE KLEARNING;
# CREATE DATABASE KLEARNING;
USE KLEARNING;

CREATE TABLE USER(
                     USERID CHAR(20) NOT NULL,
                     NICKNAME CHAR(50) NOT NULL,
                     PASSWORD CHAR(30) NOT NULL,
                     PRIMARY KEY(USERID)
);

CREATE TABLE GAME(
                     CATEGORYID INT NOT NULL,
                     PRIMARY KEY(CATEGORYID)
);

CREATE TABLE GAMELOG(
                        GAMENUM CHAR(12) NOT NULL,
                        USERID CHAR(20) NOT NULL,
                        SCORE INT NOT NULL,
                        CATEGORYID INT NOT NULL,
                        TIME INT NOT NULL,
                        PRIMARY KEY(GAMENUM),
                        FOREIGN KEY(USERID) REFERENCES USER(USERID),
                        FOREIGN KEY(CATEGORYID) REFERENCES GAME(CATEGORYID)
);

CREATE TABLE RANKING(
                        USERID CHAR(20) NOT NULL,
                        CATEGORYID INT NOT NULL,
                        SCORESUM INT NOT NULL,
                        PRIMARY KEY(USERID, CATEGORYID),
                        FOREIGN KEY(USERID) REFERENCES USER(USERID),
                        FOREIGN KEY(CATEGORYID) REFERENCES GAME(CATEGORYID)
);

CREATE TABLE WORDLIST(
                         EWORD CHAR(100) NOT NULL,
                         KWORD CHAR(100) NOT NULL,
                         CATEGORYID INT NOT NULL,
                         PRIMARY KEY(EWORD),
                         FOREIGN KEY(CATEGORYID) REFERENCES GAME(CATEGORYID)
);