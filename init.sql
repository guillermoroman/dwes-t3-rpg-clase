-- Selecciona la base de datos (asegúrate de que ya exista o créala antes)
USE dwes_t3_rpg_clase;

-- Crea la tabla users
CREATE TABLE IF NOT EXISTS users (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

-- Crea la tabla characters
CREATE TABLE IF NOT EXISTS characters (
                                          id INT AUTO_INCREMENT PRIMARY KEY,
                                          user_id INT NOT NULL,
                                          name VARCHAR(100) NOT NULL,
    description TEXT,
    health INT NOT NULL,
    strength INT NOT NULL,
    defense INT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    );

-- Crea la tabla enemies
CREATE TABLE IF NOT EXISTS enemies (
                                       id INT AUTO_INCREMENT PRIMARY KEY,
                                       user_id INT NOT NULL,
                                       name VARCHAR(100) NOT NULL,
    description TEXT,
    is_boss BOOLEAN NOT NULL DEFAULT FALSE,
    health INT NOT NULL,
    strength INT NOT NULL,
    defense INT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    );

-- Crea la tabla items
CREATE TABLE IF NOT EXISTS items (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     user_id INT NOT NULL,
                                     name VARCHAR(100) NOT NULL,
    description TEXT,
    type VARCHAR(50) NOT NULL,
    effect TEXT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    );

-- Inserta datos iniciales en la tabla users
INSERT INTO users (username, email, password) VALUES
                                                  ('admin', 'admin@example.com', 'admin_password'),
                                                  ('player1', 'player1@example.com', 'password1');

-- Inserta datos iniciales en la tabla characters
INSERT INTO characters (user_id, name, description, health, strength, defense, image) VALUES
                                                                                          (1, 'Knight', 'A brave knight with a shiny sword', 100, 15, 10, 'knight.png'),
                                                                                          (2, 'Wizard', 'A wise wizard with powerful spells', 80, 20, 5, 'wizard.png');

-- Inserta datos iniciales en la tabla enemies
INSERT INTO enemies (user_id, name, description, is_boss, health, strength, defense, image) VALUES
                                                                                                (1, 'Goblin', 'A sneaky goblin', FALSE, 50, 10, 5, 'goblin.png'),
                                                                                                (1, 'Dragon', 'A fearsome dragon', TRUE, 200, 50, 30, 'dragon.png');

-- Inserta datos iniciales en la tabla items
INSERT INTO items (user_id, name, description, type, effect, image) VALUES
                                                                        (1, 'Health Potion', 'Restores 50 health points', 'consumable', 'restore_health:50', 'health_potion.png'),
                                                                        (2, 'Magic Staff', 'Increases magic power by 10', 'weapon', 'increase_magic:10', 'magic_staff.png');