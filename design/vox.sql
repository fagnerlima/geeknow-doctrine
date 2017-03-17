CREATE TABLE client (
	id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(100) NOT NULL,
    status BOOLEAN DEFAULT true,
    version INT NULL,
    CONSTRAINT pk_client PRIMARY KEY(id)
);

CREATE TABLE account (
	id INT AUTO_INCREMENT NOT NULL,
    client_id INT NOT NULL,
    balance DECIMAL(10, 2) NOT NULL,
    status BOOLEAN DEFAULT true,
    version INT NULL,
    CONSTRAINT pk_account PRIMARY KEY(id),
    CONSTRAINT fk_account_client_id FOREIGN KEY(client_id) REFERENCES client(id)
);

CREATE TABLE skill (
	id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(100),
    CONSTRAINT pk_skill PRIMARY KEY(id)
);
