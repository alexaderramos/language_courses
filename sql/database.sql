-- Create database
CREATE DATABASE IF NOT EXISTS language_courses;
USE language_courses;

-- Create courses table
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    rating DECIMAL(2,1) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create exams table
CREATE TABLE IF NOT EXISTS exams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type ENUM('selection', 'question_answer', 'completion') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample data for courses
INSERT INTO courses (name, rating) VALUES
('Vocabulario sobre Trabajo en Inglés', 5.0),
('Conversaciones de Trabajo en Inglés', 5.0),
('Gramática Básica en Francés', 4.5),
('Vocabulario de Comida en Italiano', 4.0),
('Expresiones Cotidianas en Alemán', 4.8),
('Saludos y Presentaciones en Japonés', 3.5),
('Verbos Irregulares en Inglés', 4.2),
('Conjugación Verbal en Español', 4.7),
('Pronunciación Avanzada en Francés', 4.9),
('Vocabulario de Viajes en Portugués', 3.8);

-- Insert sample data for exams
INSERT INTO exams (name, type) VALUES
('Trabajos y ocupaciones en Inglés', 'selection'),
('Verbos básicos en Francés', 'question_answer'),
('Test de vocabulario general en Alemán', 'completion'),
('Examen de gramática en Español', 'selection'),
('Evaluación de escucha en Japonés', 'completion'),
('Prueba de escritura en Italiano', 'question_answer'),
('Examen de comprensión de lectura en Inglés', 'selection'),
('Test de vocabulario de negocios', 'selection'),
('Evaluación final de gramática francesa', 'completion'),
('Examen de vocabulario de trabajo', 'question_answer');
