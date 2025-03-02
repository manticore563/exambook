CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    duration INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    test_id INT NOT NULL,
    question_text TEXT NOT NULL,
    option_a VARCHAR(255) NOT NULL,
    option_b VARCHAR(255) NOT NULL,
    option_c VARCHAR(255) NOT NULL,
    option_d VARCHAR(255) NOT NULL,
    correct_answer CHAR(1) NOT NULL,
    FOREIGN KEY (test_id) REFERENCES tests(id)
);

CREATE TABLE user_responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    test_id INT NOT NULL,
    question_id INT NOT NULL,
    selected_answer CHAR(1),
    is_correct TINYINT(1) DEFAULT 0,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (test_id) REFERENCES tests(id),
    FOREIGN KEY (question_id) REFERENCES questions(id)
);