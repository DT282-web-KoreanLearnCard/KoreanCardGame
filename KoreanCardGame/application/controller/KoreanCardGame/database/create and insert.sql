

alter user 'klearning'@'localhost' Identified with mysql_native_password by 'webproject';
DROP DATABASE KLEARNING;
CREATE DATABASE KLEARNING;
USE KLEARNING;

CREATE TABLE USER(
	USERID CHAR(20) NOT NULL,
	NICKNAME CHAR(50) NOT NULL,
	PASSWORD CHAR(30) NOT NULL,
	PRIMARY KEY(USERID)
);

CREATE TABLE GAME(
	CATEGORYID INT NOT NULL,
    CATEGORYNAME CHAR(30) NOT NULL,
    PRIMARY KEY(CATEGORYID)
);

CREATE TABLE GAMELOG(  
	GAMENUM int auto_increment,
	USERID CHAR(20) NOT NULL,
    SCORE INT NOT NULL,
    CATEGORYID INT NOT NULL,
    PRIMARY KEY(GAMENUM),
    FOREIGN KEY(USERID) REFERENCES USER(USERID),
    FOREIGN KEY(CATEGORYID) REFERENCES GAME(CATEGORYID)
);
alter table gamelog auto_increment=1111;

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

INSERT INTO GAME VALUE(0,'Total');
INSERT INTO GAME VALUE(1,'Animal');
INSERT INTO GAME VALUE(2,'Fruit');
INSERT INTO GAME VALUE(3,'Verb');

INSERT INTO USER VALUE('ADMIN','administrator','Admin0');
INSERT INTO USER VALUE('king03','king','King33');
INSERT INTO USER VALUE('user','gamer','User0');
INSERT INTO USER VALUE('siri','siri','Siri0');
INSERT INTO USER VALUE('kiwi','kiwii','Kiwi0');
INSERT INTO USER VALUE('use','user','Use0');

INSERT INTO WORDLIST VALUE('dog','개',1);
INSERT INTO WORDLIST VALUE('cat','고양이',1);
INSERT INTO WORDLIST VALUE('bird','새',1);
INSERT INTO WORDLIST VALUE('horse','말',1);
INSERT INTO WORDLIST VALUE('lion','사자',1);
INSERT INTO WORDLIST VALUE('tiger','호랑이',1);
INSERT INTO WORDLIST VALUE('zebra','얼룩말',1);
INSERT INTO WORDLIST VALUE('giraffe','기린',1);
INSERT INTO WORDLIST VALUE('hippopotamus','하마',1);
INSERT INTO WORDLIST VALUE('crocodile','악어',1);
INSERT INTO WORDLIST VALUE('kangaroo','캥거루',1);
INSERT INTO WORDLIST VALUE('koala','코알라',1);
insert into wordlist value('snake','뱀',1);
insert into wordlist value('deer','사슴',1);
insert into wordlist value('panda','팬더',1);
insert into wordlist value('bear','곰',1);
insert into wordlist value('seal','바다표범',1);
insert into wordlist value('racoon','너구리',1);
insert into wordlist value('otther','수달',1);
insert into wordlist value('monkey','원숭이',1);



CREATE TABLE board (
  name varchar(255) NOT NULL,
  num int(10) NOT NULL AUTO_INCREMENT,
  userid varchar(255) NOT NULL,
  subject varchar(255) NOT NULL,
  memo varchar(255) NOT NULL,
  hash varchar(255) DEFAULT NULL,
  time datetime DEFAULT NULL,
  down int(10) DEFAULT 0,
  PRIMARY KEY (`num`),
  FOREIGN KEY(USERID) REFERENCES USER(USERID)
);

