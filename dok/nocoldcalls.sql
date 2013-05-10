CREATE TABLE appointment (
            id INTEGER PRIMARY KEY,
            customer_id INTEGER,
            datetime DATETIME,
            contact VARCHAR(255),
            phone VARCHAR(255),
            mobil VARCHAR(255),
            email VARCHAR(255),
            number INT(24) NULL,
            comment TEXT,
            contributor_id INTEGER,
            listed_date DATE,
            type_id INT(255),
            specialized_value TEXT);
CREATE TABLE contributor (
          id INTEGER PRIMARY KEY,
          name VARCHAR(255));
CREATE TABLE customer (
            id INTEGER PRIMARY KEY,
            organisation VARCHAR(255),
            street VARCHAR(255),
            postcode INT(5),
            city VARCHAR(255),
            phone VARCHAR(255),
            mobil VARCHAR(255),
            email VARCHAR(255),
            listed_since DATE,
            contributor_id INTEGER
            );
CREATE TABLE specialized (
          id INTEGER PRIMARY KEY,
          name VARCHAR(255),
          type_id INTEGER,
          status BOOLEAN);
CREATE TABLE type (
          id INTEGER PRIMARY KEY,
          name VARCHAR(255));
