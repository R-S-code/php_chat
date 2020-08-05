DROP TABLE IF EXISTS chat;

CREATE TABLE chat (
    id int AUTO_INCREMENT,
    name VARCHAR(20),
    message VARCHAR(40),
    time TIMESTAMP,
    PRIMARY KEY(id)
);