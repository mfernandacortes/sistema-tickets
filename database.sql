CREATE TABLE usuarios(
dni INT PRIMARY KEY,
nombre VARCHAR(100),
departamento VARCHAR(100),
cargo VARCHAR(100)
);

CREATE TABLE tickets(
idTicket INT AUTO_INCREMENT PRIMARY KEY,
dni INT,
fecha DATETIME,
estado VARCHAR(20),
problema VARCHAR(255),
detalle TEXT,
resuelto_por VARCHAR(100),
FOREIGN KEY(dni) REFERENCES usuarios(dni)
);