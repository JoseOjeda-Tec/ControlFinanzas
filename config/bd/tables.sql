CREATE TABLE USERS(
    id_user int NOT NULL AUTO_INCREMENT,
    usuario varchar(50) NOT NULL,
    nombre varchar(50) NOT NULL,
    apellido varchar(50) NOT NULL,
    pass varchar(50) NOT NULL,
    correo varchar(50) NOT NULL,
    user_create int NOT NULL,
    fecha_set varchar(30) NOT NULL,
    fecha_upd varchar(30) NOT NULL,
    fecha_dlt varchar(30) NOT NULL,
    data_active int DEFAULT 1,
    PRIMARY KEY (id_user)
);

INSERT INTO USERS (usuario, nombre, apellido, pass, correo, user_create, fecha_set, fecha_upd, fecha_dlt) VALUES
('jojeda', 'José', 'Ojeda', '5948caa5399ab1af9e9b4994caa46182', 'alexi.ahumada93@gmail.com', 1, '09-08-2024 09:00:04', '0', '0');#Az19Sx

CREATE TABLE ALL_LOGS(
    id_log int NOT NULL AUTO_INCREMENT,
    descripcion varchar(50) NOT NULL,
    modulo varchar(50) NOT NULL,
    sub_modulo varchar(50) NOT NULL,
    accion varchar(50) NOT NULL,
    id_user int NULL,
    fecha_log varchar(30) NOT NULL,
    PRIMARY KEY (id_log),
    FOREIGN KEY (id_user) REFERENCES USERS(id_user)
);

CREATE TABLE BANK(
    id_bank int NOT NULL AUTO_INCREMENT,
    descripcion varchar(50) NOT NULL,
    tipo_cuenta varchar(50) NOT NULL,
    id_user int NOT NULL,
    fecha_set varchar(30) NOT NULL,
    fecha_upd varchar(30) NOT NULL,
    fecha_dlt varchar(30) NOT NULL,
    data_active int DEFAULT 1,
    PRIMARY KEY (id_bank),
    FOREIGN KEY (id_user) REFERENCES USERS(id_user)
);

CREATE TABLE INCOME(
    id_income int NOT NULL AUTO_INCREMENT,
    descripcion varchar(50) NOT NULL,
    monto int NOT NULL,
    id_bank int NOT NULL,
    fecha_ing varchar(20) NOT NULL,
    type_trans varchar(30) NOT NULL,
    id_user int NOT NULL,
    fecha_set varchar(30) NOT NULL,
    fecha_upd varchar(30) NOT NULL,
    fecha_dlt varchar(30) NOT NULL,
    data_active int DEFAULT 1,
    PRIMARY KEY (id_income),
    FOREIGN KEY (id_bank) REFERENCES BANK(id_bank),
    FOREIGN KEY (id_user) REFERENCES USERS(id_user)
);