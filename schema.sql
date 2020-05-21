CREATE DATABASE doingsdone
	DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;
	
USE doingsdone;

CREATE TABLE users (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
	name VARCHAR(255) NOT NULL,
	email VARCHAR(128) UNIQUE NOT NULL,
	creation_time DATETIME NOT NULL,
	password VARCHAR(64) NOT NULL
);

CREATE TABLE projects (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
	name VARCHAR(255) NOT NULL,
	user_id INT UNSIGNED NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE tasks (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
	name VARCHAR(255) NOT NULL,
	creation_time DATETIME NOT NULL,
	deadline_time DATETIME NOT NULL,
	file VARCHAR(255) NOT NULL,
	status TINYINT(1) DEFAULT 0 NOT NULL,
	user_id INT UNSIGNED NOT NULL,
	project_id INT UNSIGNED NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (project_id) REFERENCES projects(id)
);

CREATE INDEX project_name ON projects(name);
CREATE INDEX projects_user_id ON projects(user_id);
CREATE INDEX tasks_user_id ON tasks(user_id);
CREATE INDEX tasks_project_id ON tasks(project_id);
CREATE INDEX users_id ON users(id);