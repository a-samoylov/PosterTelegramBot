DROP TABLE IF EXISTS telegram_chat;
CREATE TABLE telegram_chat (
  id         INT         NOT NULL,
  type       VARCHAR(20) NOT NULL,
  username   VARCHAR(255) DEFAULT NULL,
  first_name VARCHAR(255) DEFAULT NULL,
  last_name  VARCHAR(255) DEFAULT NULL,
  UNIQUE INDEX id (id)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci
  ENGINE = InnoDB;

CREATE TABLE telegram_bot (
  id         INT AUTO_INCREMENT NOT NULL,
  name       VARCHAR(50)        NOT NULL,
  token      VARCHAR(50)        NOT NULL,
  access_key VARCHAR(50)        NOT NULL,
  PRIMARY KEY (id)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci
  ENGINE = InnoDB;

CREATE TABLE telegram_layout (
  id           INT AUTO_INCREMENT NOT NULL,
  bot          INT                NOT NULL,
  name         VARCHAR(255)       NOT NULL,
  text         VARCHAR(1000)      NOT NULL,
  reply_markup JSON DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT bot FOREIGN KEY (bot) REFERENCES telegram_bot (id)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci
  ENGINE = InnoDB;

CREATE TABLE user (
  id             INT AUTO_INCREMENT NOT NULL,
  phone          VARCHAR(50) DEFAULT NULL,
  chat           INT                NOT NULL,
  telegram_bot   INT                NOT NULL,
  current_layout INT                NOT NULL,
  settings       JSON        DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT chat FOREIGN KEY (chat) REFERENCES telegram_chat (id),
  CONSTRAINT telegram_bot FOREIGN KEY (telegram_bot) REFERENCES telegram_bot (id),
  UNIQUE INDEX chat (chat),
  UNIQUE INDEX telegram_bot (telegram_bot)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci
  ENGINE = InnoDB;

CREATE TABLE telegram_callback_message (
  id           INT AUTO_INCREMENT NOT NULL,
  type         SMALLINT           NOT NULL,
  name         VARCHAR(70)  DEFAULT NULL,
  message_text VARCHAR(255) DEFAULT NULL,
  data         JSON         DEFAULT NULL,
  create_date  DATETIME           NOT NULL,
  PRIMARY KEY (id)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci
  ENGINE = InnoDB;

CREATE TABLE telegram_send_callback_message (
  id        INT AUTO_INCREMENT NOT NULL,
  bot       INT                NOT NULL,
  layout    INT                NOT NULL,
  button_id INT DEFAULT NULL,
  action    LONGTEXT           NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT FK_9BAB26C611F0411 FOREIGN KEY (bot) REFERENCES telegram_bot (id),
  CONSTRAINT FK_9BAB26C63A3A6BE2 FOREIGN KEY (layout) REFERENCES telegram_layout (id)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci
  ENGINE = InnoDB;

