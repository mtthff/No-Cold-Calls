CREATE TABLE appointment (
            id INTEGER PRIMARY KEY,
            status_id INTEGER,
            customer_id INTEGER,
            datetime NUMERIC,
            contact TEXT,
            phone TEXT,
            email TEXT,
            number INTEGER,
            comment TEXT,
            contributor_id INTEGER,
            listed_date NUMERIC,
            type_id INTEGER,
            age TEXT,
            tarif_id INTEGER,
            juhe NUMERIC,
            version_id INTEGER,
            fotocd NUMERIC
            );
CREATE TABLE appointment_status (
          id INTEGER PRIMARY KEY,
          label TEXT
          );
CREATE TABLE appointment_tarif (
          id INTEGER PRIMARY KEY,
          label TEXT
          );
CREATE TABLE appointment_type (
          id INTEGER PRIMARY KEY,
          label TEXT
          );
CREATE TABLE appointment_version (
          id INTEGER PRIMARY KEY,
          label TEXT
          );
CREATE TABLE contributor (
          id INTEGER PRIMARY KEY,
          name TEXT
          );
CREATE TABLE customer (
            id INTEGER PRIMARY KEY,
            organisation TEXT,
            street TEXT,
            postcode INTEGER,
            city TEXT,
            phone TEXT,
            email TEXT,
            listed_since NUMERIC,
            contributor_id INTEGER
        );
