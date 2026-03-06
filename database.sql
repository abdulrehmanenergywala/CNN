CREATE DATABASE IF NOT EXISTS rsoa_rso211_41;
USE rsoa_rso211_41;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Categories table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

-- Articles table
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    content TEXT,
    image VARCHAR(255),
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- Insert Categories
INSERT INTO categories (name) VALUES 
('World'), ('Sports'), ('Technology'), ('Entertainment');

-- Insert Articles (10 dummy articles)
INSERT INTO articles (title, description, content, image, category_id) VALUES
('Breaking News 1', 'Short description 1', 'Full content for article 1.', 'https://via.placeholder.com/600x400', 1),
('Sports Highlight 1', 'Short description 2', 'Full content for article 2.', 'https://via.placeholder.com/600x400', 2),
('Tech Update 1', 'Short description 3', 'Full content for article 3.', 'https://via.placeholder.com/600x400', 3),
('Entertainment Buzz 1', 'Short description 4', 'Full content for article 4.', 'https://via.placeholder.com/600x400', 4),
('World News 2', 'Short description 5', 'Full content for article 5.', 'https://via.placeholder.com/600x400', 1),
('Sports Highlight 2', 'Short description 6', 'Full content for article 6.', 'https://via.placeholder.com/600x400', 2),
('Tech Update 2', 'Short description 7', 'Full content for article 7.', 'https://via.placeholder.com/600x400', 3),
('Entertainment Buzz 2', 'Short description 8', 'Full content for article 8.', 'https://via.placeholder.com/600x400', 4),
('World News 3', 'Short description 9', 'Full content for article 9.', 'https://via.placeholder.com/600x400', 1),
('Tech Update 3', 'Short description 10', 'Full content for article 10.', 'https://via.placeholder.com/600x400', 3);
