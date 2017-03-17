CREATE TABLE client (
  id SERIAL NOT NULL,
  name VARCHAR(100) NOT NULL,
  status BOOLEAN DEFAULT true,
  version INT NOT NULL DEFAULT 1,
  CONSTRAINT pk_client PRIMARY KEY(id)
);

CREATE TABLE account (
  id SERIAL NOT NULL,
  client_id INT NOT NULL,
  balance DECIMAL(10, 2) NOT NULL,
  status BOOLEAN DEFAULT true,
  version INT NOT NULL DEFAULT 1,
  CONSTRAINT pk_account PRIMARY KEY(id),
  CONSTRAINT fk_account_client_id FOREIGN KEY(client_id) REFERENCES client(id)
);

CREATE TABLE skill (
  id SERIAL NOT NULL,
  name VARCHAR(100),
  CONSTRAINT pk_skill PRIMARY KEY(id)
);

INSERT INTO client (name, status, version) VALUES
  ('Client 1', true, 1),
  ('Client 2', true, 1),
  ('Client 3', false, 1),
  ('Client 4', true, 1),
  ('Client 5', false, 1),
  ('Client 6', true, 1);

INSERT INTO account (client_id, balance, status, version) VALUES
  (1, 500, true, 1),
  (2, 5300, true, 1),
  (3, 3500, false, 1),
  (4, 8500, false, 1),
  (5, 1000, true, 1),
  (6, 100, false, 1);

INSERT INTO skill (name) VALUES
  ('PHP'),
  ('Angular'),
  ('Java');

SELECT * FROM client;
SELECT * FROM account;
SELECT * FROM skill;
