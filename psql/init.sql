CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    is_active BOOLEAN DEFAULT FALSE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

INSERT INTO users (email, full_name, is_active)
  VALUES 
    ('john@doe.com', 'John Doe', TRUE),
    ('jane@doe.com', 'Jane Doe', TRUE)
;
  

CREATE TABLE IF NOT EXISTS invoices (
  id SERIAL PRIMARY KEY,
  amount DECIMAL(10, 4) NOT NULL, -- 10 digits, 4 decimal places
  user_id INTEGER
    REFERENCES users(id) 
    ON DELETE SET NULL
    ON UPDATE CASCADE
);
