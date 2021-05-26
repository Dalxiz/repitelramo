CREATE TABLE TIPO_USUARIO(
idTipoUsu INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
nombreTipoUsu VARCHAR(50) NOT NULL) ENGINE=InnoDB;

CREATE TABLE USUARIO(
idUsu INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
idTipoUsu INT NOT NULL,
nombreUsu VARCHAR(100) NOT NULL,
passUsu VARCHAR(50) NOT NULL,
correoUsu VARCHAR(100) NOT NULL,
FOREIGN KEY (idTipoUsu) REFERENCES TIPO_USUARIO (idTipoUsu)) ENGINE=InnoDB;

CREATE TABLE UNIDAD_MEDIDA(
idUM INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
nombreUM VARCHAR(50) NOT NULL) ENGINE=InnoDB;

CREATE TABLE PRODUCTO(
codProd VARCHAR(9) NOT NULL PRIMARY KEY,
descripcion VARCHAR(200) NOT NULL,
idUM INT NOT NULL,
precioUnitario DECIMAL(15,2) NOT NULL,
FOREIGN KEY (idUM) REFERENCES UNIDAD_MEDIDA(idUM)) ENGINE=InnoDB;

CREATE TABLE CLIENTE(
rutCliente INT NOT NULL PRIMARY KEY,
dvCliente CHAR(1) NOT NULL,
nomb_razonSocial VARCHAR(100) NOT NULL,
giro VARCHAR(150) NOT NULL,
direccion VARCHAR(150) NOT NULL,
comuna VARCHAR(100) NOT NULL,
ciudad VARCHAR(100) NOT NULL,
telefono INT,
email VARCHAR(100)) ENGINE=InnoDB;

CREATE TABLE TIPO_DOCUMENTO(
idTipoDoc INT PRIMARY KEY AUTO_INCREMENT,
nombreTipoDoc VARCHAR (100)) ENGINE=InnoDB;    

CREATE TABLE EMPRESA(
rutEmp INT NOT NULL PRIMARY KEY,
dvEmp CHAR(1) NOT NULL,
razonSocialEmp VARCHAR(200) NOT NULL,
giroEmp VARCHAR(200) NOT NULL) ENGINE=InnoDB;

CREATE TABLE ENCABEZADO_DOCUMENTO(
idUsu INT NOT NULL,
rutEmp INT NOT NULL,
idTipoDoc INT NOT NULL,
folioDoc INT NOT NULL,
fechaEmision DATE NOT NULL,
rutCliente INT NOT NULL,
condPago VARCHAR(100) NOT NULL,
estadoDoc VARCHAR(20) NOT NULL,
neto NUMERIC (15,2),
iva NUMERIC (15,2),
total NUMERIC (15,2),
observaciones VARCHAR (250),
canceladoPor VARCHAR (200),
PRIMARY KEY (idTipoDoc, folioDoc),
FOREIGN KEY (idUsu) REFERENCES USUARIO (idUsu),
FOREIGN KEY (rutEmp) REFERENCES EMPRESA (rutEmp),
FOREIGN KEY(idTipoDoc) REFERENCES TIPO_DOCUMENTO(idTipoDoc),
FOREIGN KEY (rutCliente) REFERENCES CLIENTE (rutCliente)) ENGINE=InnoDB;

CREATE TABLE DETALLE_DOCUMENTO(
idDetalle INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
idTipoDoc INT NOT NULL,
folioDoc INT NOT NULL,
codProd VARCHAR(9) NOT NULL,
precioUnitario DECIMAL(15,2) NOT NULL,
cantUnitaria INT NOT NULL,
descuento DECIMAL (5,2) NOT NULL,
valor DECIMAL (15,2) NOT NULL,
FOREIGN KEY (idTipoDoc, folioDoc) REFERENCES ENCABEZADO_DOCUMENTO(idTipoDoc, folioDoc),
FOREIGN KEY (codProd) REFERENCES PRODUCTO (codProd)) ENGINE=InnoDB;

/*INSERT*/


INSERT INTO CLIENTE
(rutCliente, dvCliente, nomb_razonSocial, giro, direccion, comuna, ciudad, telefono, email)
VALUES
(18019735, '4', 'Ignacio Barría', 'Particular', 'Vicuña Mackenna','San Joaquin', 'Santiago', 979097002, 'ignacio.barria.o@gmail.com'),
(25324415, '5', 'Nicolas Salomón', 'Particular', 'Pasaje 34','Peñaloken', 'Santiago', 965659656, 'nico.guzman@gmail.com');

INSERT INTO TIPO_DOCUMENTO
(nombreTipoDoc)
VALUES
('Factura Electrónica'),
('Notas de crédito');

/* ¿Agegar abreviación de UM?*/
INSERT INTO UNIDAD_MEDIDA
(nombreUM)
VALUES
('Pieza'),
('Kilogramo'),
('Metro');

INSERT INTO PRODUCTO
(codProd, descripcion, idUM, precioUnitario)
VALUES
('1', 'Notebook Lenoveo Z34', 1, 250000),
('2', 'Mouse Pro Gamer Asus X2', 1, 75000),
('3', 'Trozo de metal', 2, 1000);

INSERT INTO EMPRESA
(rutEmp, dvEmp, razonSocialEmp, giroEmp)
VALUES
(1111111, '2', 'REPI TELRAMO ELECTRONICS LTDA', 'Venta de productos electrónicos');


INSERT INTO TIPO_USUARIO
(nombreTipoUsu)
VALUES
('Administrador'),
('Operador');

INSERT INTO USUARIO
(idTipoUsu, nombreUsu, passUsu, correoUsu)
VALUES
(1, 'Wache', '123', 'wachemowe@gmail.com'),
(2, 'NachoLo', '123', 'nacholo@gmail.com');


INSERT INTO ENCABEZADO_DOCUMENTO
(idUsu, rutEmp, idTipoDoc, folioDoc, fechaEmision, rutCliente, condPago, estadoDoc, observaciones, canceladoPor)
VALUES
(1, 1111111, 1, 100, '2020-12-19', 18019735, 'Por pagar', 'Emitida' , 'Venta unica' , 'Ignacio Barría'),
(1, 1111111, 2, 100, '2020-12-20', 18019735, 'Pagado', 'Anulada', 'Venta unica', 'Ignacio Barría');


/*Primero lo haremos CON UN VALOR DETERMINADO, sin SP, despues si*/
INSERT INTO DETALLE_DOCUMENTO 
(idTipoDoc, folioDoc, codProd, precioUnitario, cantUnitaria, descuento, valor)
VALUES
(1, 100, 1, 250000, 4, 0, 1000000),
(1, 100, 2, 75000, 2, 0, 150000),
(2, 100, 1, 250000, 2, 0, 500000),
(2, 100, 3, 1000, 10, 10, 9000);


DELIMITER //
CREATE PROCEDURE sp_computar (idTipoDocPar INT, folioDocPar INT)
BEGIN
DECLARE Vsubtotal NUMERIC(15,2);
DECLARE Viva NUMERIC(15,2);
DECLARE Vtotal NUMERIC(15,2);
SET Vsubtotal = (SELECT SUM(valor) FROM DETALLE_DOCUMENTO WHERE idTipoDoc = idTipoDocPar AND folioDoc = folioDocPar);

SET Viva = Vsubtotal*0.19;
SET Vtotal = Vsubtotal + Viva;

UPDATE ENCABEZADO_DOCUMENTO SET neto = Vsubtotal, iva=Viva, total=Vtotal WHERE idTipoDoc = idTipoDocPar AND folioDoc = folioDocPar;
END //

DELIMITER ;
