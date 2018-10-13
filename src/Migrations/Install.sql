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

DROP TABLE IF EXISTS user;
CREATE TABLE user (
  id            INT      NOT NULL,
  phone         VARCHAR(50) DEFAULT NULL,
  intensity     SMALLINT    DEFAULT NULL,
  register_step SMALLINT NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT telegram_chat_id FOREIGN KEY (id) REFERENCES telegram_chat (id)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci
  ENGINE = InnoDB;

DROP TABLE IF EXISTS subject;
CREATE TABLE subject (
  id         INT AUTO_INCREMENT NOT NULL,
  name       VARCHAR(70)        NOT NULL,
  short_name VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (id)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci
  ENGINE = InnoDB;

CREATE TABLE users_subjects (
  user_id    INT NOT NULL,
  subject_id INT NOT NULL,
  INDEX user_id (user_id),
  INDEX subject_id (subject_id),
  PRIMARY KEY (user_id, subject_id),
  CONSTRAINT user_id FOREIGN KEY (user_id) REFERENCES user (id),
  CONSTRAINT subject_id FOREIGN KEY (subject_id) REFERENCES subject (id)
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
  id          INT AUTO_INCREMENT NOT NULL,
  callback_id INT                NOT NULL,
  answer_date DATETIME DEFAULT NULL,
  send_date   DATETIME           NOT NULL,
  INDEX callback_id (callback_id),
  CONSTRAINT telegram_callback_message_id FOREIGN KEY (callback_id) REFERENCES telegram_callback_message (id),
  PRIMARY KEY (id)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci
  ENGINE = InnoDB;

INSERT INTO subject (name, short_name) VALUES ('Українська мова', 'Укр. мова');
INSERT INTO subject (name) VALUES ('Математика');
INSERT INTO subject (name) VALUES ('Фізика');
INSERT INTO subject (name, short_name) VALUES ('Англійска мова', 'Англ. мова');


INSERT INTO telegram_callback_message(type, name, message_text, data, create_date) VALUES
(0, 'subject_step', 'Оберіть предмети', '[{"id": 1, "text": "Україньска мова"}, {"id": 2, "text": "Математика"}, {"id": 3, "text": "Фізика"}, {"id": 4, "text": "Наступні"}, {"id": 5, "text": "Попередні"}, {"id": 6, "text": "Зберегти"}]', '2018-09-25 00:00:00');
INSERT INTO telegram_callback_message(type, name, message_text, data, create_date) VALUES
(0, 'intensity_step', 'Оберіть інтенсивність заннять', '[{"id": 1, "text": "Мала"}, {"id": 2, "text": "Середня"}, {"id": 3, "text": "Велика"}]', '2018-09-24 00:00:00');
