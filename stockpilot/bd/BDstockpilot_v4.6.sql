-- BD StockPilot v4.6 (versión adaptada según indicaciones del usuario)
-- Basado en el script original. Fuente: archivo proporcionado por el usuario. :contentReference[oaicite:1]{index=1}

-- TABLAS --
DROP DATABASE IF EXISTS stockpilot;
CREATE DATABASE stockPilot;

CREATE TABLE usuario (
    idusu INT(10) PRIMARY KEY AUTO_INCREMENT,
    nomusu VARCHAR(100),
    apeusu VARCHAR(100),
    tdousu VARCHAR(20) COMMENT 'Tipo doc (valor dominio)',
    ndousu VARCHAR(20),
    celusu VARCHAR(15),
    emausu VARCHAR(100),
    pasusu VARCHAR(255),
    imgusu VARCHAR(255),
    idper INT(10),
    tokreset VARCHAR(255),
    fecreset DATETIME,
    ultlogin DATETIME,
    fec_crea DATETIME,
    fec_actu DATETIME,
    act TINYINT(1)
);

CREATE TABLE usuario_empresa (
    idusu INT(10),
    idemp INT(10),
    fec_crea DATETIME
);

CREATE TABLE perfil (
    idper INT(10) PRIMARY KEY AUTO_INCREMENT,
    codper VARCHAR(20),
    nomper VARCHAR(100),
    nivel TINYINT,
    fec_crea DATETIME,
    fec_actu DATETIME,
    act TINYINT(1)
);

CREATE TABLE empresa (
    estado TINYINT(1),
    idemp INT(10) PRIMARY KEY AUTO_INCREMENT,
    nomemp VARCHAR(100),
    razemp VARCHAR(150),
    nitemp VARCHAR(20) UNIQUE,
    diremp VARCHAR(150),
    telemp VARCHAR(15),
    emaemp VARCHAR(100),
    logo VARCHAR(255),
    idusu INT(10) COMMENT 'Usuario creador',
    fec_crea DATETIME,
    fec_actu DATETIME,
    act TINYINT(1)
);

CREATE TABLE ubicacion (
    idubi INT(10) PRIMARY KEY AUTO_INCREMENT,
    nomubi VARCHAR(100),
    codubi VARCHAR(20),
    dirubi VARCHAR(150),
    depubi VARCHAR(100),
    ciuubi VARCHAR(100),
    idemp INT(10),
    idresp INT(10),
    fec_crea DATETIME,
    fec_actu DATETIME,
    act TINYINT(1)
);

CREATE TABLE categoria (
    idcat INT(10) PRIMARY KEY AUTO_INCREMENT,
    nomcat VARCHAR(100),
    descat VARCHAR(255),
    idemp INT(10),
    fec_crea DATETIME,
    fec_actu DATETIME,
    act TINYINT(1)
);

CREATE TABLE producto (
    tipo_inventario TINYINT(1) COMMENT '1=Mercancías, 2=Materia Prima, 3=En Proceso, 4=Terminados',
    idprod INT(10) PRIMARY KEY AUTO_INCREMENT,
    codprod VARCHAR(20),
    nomprod VARCHAR(100),
    desprod VARCHAR(200),
    idcat INT(10),
    idemp INT(10),
    unimed VARCHAR(20),
    stkmin INT,
    stkmax INT,
    imgprod VARCHAR(255),
    fec_crea DATETIME,
    fec_actu DATETIME,
    act TINYINT(1)
);

CREATE TABLE proveedor (
    idprov INT(10) PRIMARY KEY AUTO_INCREMENT,
    idubi INT(10),
    tipoprov VARCHAR(20),
    nomprov VARCHAR(100),
    docprov VARCHAR(20),
    telprov VARCHAR(15),
    emaprov VARCHAR(100),
    dirprov VARCHAR(150),
    idemp INT(10),
    fec_crea DATETIME,
    fec_actu DATETIME,
    act TINYINT(1)
);

CREATE TABLE inventario (
    idinv INT(10) PRIMARY KEY AUTO_INCREMENT,
    idemp INT(10),
    idprod INT(10),
    idubi INT(10),
    cant INT,
    fec_crea DATETIME,
    fec_actu DATETIME
);

CREATE TABLE kardex (
    idkar INT(10) PRIMARY KEY AUTO_INCREMENT,
    idemp INT(10),
    anio INT,
    mes TINYINT,
    cerrado TINYINT(1),
    fec_crea DATETIME,
    fec_actu DATETIME
);

CREATE TABLE movim (
    idmov INT(10) PRIMARY KEY AUTO_INCREMENT,
    idemp INT(10),
    idkar INT(10),
    idprod INT(10),
    idubi INT(10),
    fecmov DATE,
    tipmov TINYINT(2) COMMENT '1=ENTRADA, 2=SALIDA',
    cantmov INT,
    valmov DECIMAL(12,2),
    costprom DECIMAL(12,2),
    docref VARCHAR(50),
    obs TEXT,
    idusu INT(10),
    fec_crea DATETIME,
    fec_actu DATETIME
);

CREATE TABLE solentrada (
    idsol INT(10) PRIMARY KEY AUTO_INCREMENT,
    idemp INT(10),
    idprov INT(10),
    idubi INT(10),
    fecsol DATE,
    fecent DATE,
    tippag VARCHAR(20),
    estsol VARCHAR(20),
    totsol DECIMAL(12,2),
    obssol TEXT,
    idusu INT(10),
    idusu_apr INT(10),
    fec_crea DATETIME,
    fec_actu DATETIME
);

CREATE TABLE solsalida (
    idsol INT(10) PRIMARY KEY AUTO_INCREMENT,
    idemp INT(10),
    idubi INT(10),
    fecsol DATE,
    estsol VARCHAR(20),
    totsol DECIMAL(12,2),
    obssol TEXT,
    idusu INT(10),
    idusu_apr INT(10),
    fec_crea DATETIME,
    fec_actu DATETIME
);

CREATE TABLE detentrada (
    iddet INT(10) PRIMARY KEY AUTO_INCREMENT,
    idemp INT(10),
    idsol INT(10),
    idprod INT(10),
    cantdet INT,
    vundet DECIMAL(10,2),
    totdet DECIMAL(10,2) GENERATED ALWAYS AS (cantdet * vundet) STORED,
    fec_crea DATETIME,
    fec_actu DATETIME
);

CREATE TABLE detsalida (
    iddet INT(10) PRIMARY KEY AUTO_INCREMENT,
    idemp INT(10),
    idsol INT(10),
    idprod INT(10),
    cantdet INT,
    vundet DECIMAL(10,2),
    totdet DECIMAL(10,2) GENERATED ALWAYS AS (cantdet * vundet) STORED,
    fec_crea DATETIME,
    fec_actu DATETIME
);

CREATE TABLE dominio (
    iddom INT(10) PRIMARY KEY AUTO_INCREMENT,
    nomdom VARCHAR(100),
    desdom VARCHAR(255),
    fec_crea DATETIME,
    fec_actu DATETIME,
    act TINYINT(1)
);

CREATE TABLE valor (
    idval INT(10) PRIMARY KEY AUTO_INCREMENT,
    nomval VARCHAR(100),
    iddom INT(10),
    codval VARCHAR(20),
    desval VARCHAR(255),
    fec_crea DATETIME,
    fec_actu DATETIME,
    act TINYINT(1)
);

CREATE TABLE modulo (
    idmod INT(10) PRIMARY KEY AUTO_INCREMENT,
    nommod VARCHAR(100),
    icono VARCHAR(50),
    ruta VARCHAR(100),
    orden TINYINT,
    fec_crea DATETIME,
    fec_actu DATETIME,
    act TINYINT(1)
);

CREATE TABLE pagina (
    idpag INT(10) PRIMARY KEY AUTO_INCREMENT,
    idmod INT(10),
    nompag VARCHAR(100),
    ruta VARCHAR(100),
    icono VARCHAR(50),
    orden TINYINT,
    fec_crea DATETIME,
    fec_actu DATETIME,
    act TINYINT(1)
);

CREATE TABLE pxp (
    idpxp INT(10) PRIMARY KEY AUTO_INCREMENT,
    idper INT(10),
    idpag INT(10),
    ver TINYINT(1),
    crear TINYINT(1),
    editar TINYINT(1),
    eliminar TINYINT(1),
    fec_crea DATETIME
);

CREATE TABLE auditoria (
    idaud INT(10) PRIMARY KEY AUTO_INCREMENT,
    idemp INT(10),
    idusu INT(10),
    tabla VARCHAR(50),
    accion TINYINT(2) COMMENT '1=INSERT, 2=UPDATE, 3=DELETE',
    idreg INT(10),
    datos_ant TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    datos_nue TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    fecha DATETIME,
    ip VARCHAR(45)
);

CREATE TABLE lote (
    idlote INT(10) PRIMARY KEY AUTO_INCREMENT,
    idprod INT(10),          -- Producto asociado
    codlote VARCHAR(50),     -- Código o referencia del lote
    fecven DATE,             -- Fecha de vencimiento (opcional)
    cant INT,                -- Cantidad disponible en el lote
    fec_crea DATETIME,
    fec_actu DATETIME
);

-- INDICES --

-- Mantengo índices únicos de negocio (si quieres que los quite, lo hago)
ALTER TABLE inventario ADD UNIQUE KEY uk_inv_emp_prod_ubi (idemp, idprod, idubi);
ALTER TABLE kardex ADD UNIQUE KEY uk_kardex (idemp, anio, mes);

-- Para seguir el estilo "instructor" añadimos índices en las tablas intermedias y FKs después
ALTER TABLE usuario_empresa ADD KEY fk_ue_idusu (idusu);
ALTER TABLE usuario_empresa ADD KEY fk_ue_idemp (idemp);

ALTER TABLE pagina ADD KEY fk_pg_idmod (idmod);
ALTER TABLE pxp ADD KEY fk_pxp_idper (idper);
ALTER TABLE pxp ADD KEY fk_pxp_idpag (idpag);

ALTER TABLE proveedor ADD KEY fk_prv_idubi (idubi);
ALTER TABLE proveedor ADD KEY fk_prv_idemp (idemp);

ALTER TABLE ubicacion ADD KEY fk_ubi_idemp (idemp);
ALTER TABLE ubicacion ADD KEY fk_ubi_idresp (idresp);

ALTER TABLE producto ADD KEY fk_prod_idcat (idcat);
ALTER TABLE producto ADD KEY fk_prod_idemp (idemp);

ALTER TABLE inventario ADD KEY fk_inv_idemp (idemp);
ALTER TABLE inventario ADD KEY fk_inv_idprod (idprod);
ALTER TABLE inventario ADD KEY fk_inv_idubi (idubi);

ALTER TABLE movim ADD KEY fk_movim_idemp (idemp);
ALTER TABLE movim ADD KEY fk_movim_idkar (idkar);
ALTER TABLE movim ADD KEY fk_movim_idprod (idprod);
ALTER TABLE movim ADD KEY fk_movim_idubi (idubi);
ALTER TABLE movim ADD KEY fk_movim_idusu (idusu);

ALTER TABLE solentrada ADD KEY fk_solent_idemp (idemp);
ALTER TABLE solentrada ADD KEY fk_solent_idprov (idprov);
ALTER TABLE solentrada ADD KEY fk_solent_idubi (idubi);
ALTER TABLE solentrada ADD KEY fk_solent_idusu (idusu);
ALTER TABLE solentrada ADD KEY fk_solent_idusuapr (idusu_apr);

ALTER TABLE solsalida ADD KEY fk_solsal_idemp (idemp);
ALTER TABLE solsalida ADD KEY fk_solsal_idubi (idubi);
ALTER TABLE solsalida ADD KEY fk_solsal_idusu (idusu);
ALTER TABLE solsalida ADD KEY fk_solsal_idusuapr (idusu_apr);

ALTER TABLE detentrada ADD KEY fk_detent_idemp (idemp);
ALTER TABLE detentrada ADD KEY fk_detent_idsol (idsol);
ALTER TABLE detentrada ADD KEY fk_detent_idprod (idprod);

ALTER TABLE detsalida ADD KEY fk_detsal_idemp (idemp);
ALTER TABLE detsalida ADD KEY fk_detsal_idsol (idsol);
ALTER TABLE detsalida ADD KEY fk_detsal_idprod (idprod);

ALTER TABLE valor ADD KEY fk_val_iddom (iddom);

ALTER TABLE lote ADD KEY fk_lote_idprod (idprod);

-- RELACIONES --

ALTER TABLE usuario ADD CONSTRAINT fkuspe FOREIGN KEY (idper) REFERENCES perfil(idper);

ALTER TABLE usuario_empresa
  ADD CONSTRAINT fk_ue_us FOREIGN KEY (idusu) REFERENCES usuario(idusu),
  ADD CONSTRAINT fk_ue_em FOREIGN KEY (idemp) REFERENCES empresa(idemp);

ALTER TABLE empresa ADD CONSTRAINT fkemus FOREIGN KEY (idusu) REFERENCES usuario(idusu);

ALTER TABLE ubicacion ADD CONSTRAINT fkubem FOREIGN KEY (idemp) REFERENCES empresa(idemp);
ALTER TABLE ubicacion ADD CONSTRAINT fkubus FOREIGN KEY (idresp) REFERENCES usuario(idusu);

ALTER TABLE categoria ADD CONSTRAINT fkcaem FOREIGN KEY (idemp) REFERENCES empresa(idemp);

ALTER TABLE producto ADD CONSTRAINT fkprca FOREIGN KEY (idcat) REFERENCES categoria(idcat);
ALTER TABLE producto ADD CONSTRAINT fkprem FOREIGN KEY (idemp) REFERENCES empresa(idemp);

ALTER TABLE proveedor ADD CONSTRAINT fkprub FOREIGN KEY (idubi) REFERENCES ubicacion(idubi);
ALTER TABLE proveedor ADD CONSTRAINT fkpremp FOREIGN KEY (idemp) REFERENCES empresa(idemp);

ALTER TABLE inventario
  ADD CONSTRAINT fk_inv_emp FOREIGN KEY (idemp) REFERENCES empresa(idemp),
  ADD CONSTRAINT fk_inv_prod FOREIGN KEY (idprod) REFERENCES producto(idprod),
  ADD CONSTRAINT fk_inv_ubi FOREIGN KEY (idubi) REFERENCES ubicacion(idubi);

ALTER TABLE kardex ADD CONSTRAINT fkkaem FOREIGN KEY (idemp) REFERENCES empresa(idemp);

ALTER TABLE movim
  ADD CONSTRAINT fk_movim_emp FOREIGN KEY (idemp) REFERENCES empresa(idemp),
  ADD CONSTRAINT fk_movim_kar FOREIGN KEY (idkar) REFERENCES kardex(idkar),
  ADD CONSTRAINT fk_movim_prod FOREIGN KEY (idprod) REFERENCES producto(idprod),
  ADD CONSTRAINT fk_movim_ubi FOREIGN KEY (idubi) REFERENCES ubicacion(idubi),
  ADD CONSTRAINT fk_movim_usu FOREIGN KEY (idusu) REFERENCES usuario(idusu);

ALTER TABLE solentrada
  ADD CONSTRAINT fk_solent_emp FOREIGN KEY (idemp) REFERENCES empresa(idemp),
  ADD CONSTRAINT fk_solent_prov FOREIGN KEY (idprov) REFERENCES proveedor(idprov),
  ADD CONSTRAINT fk_solent_ubi FOREIGN KEY (idubi) REFERENCES ubicacion(idubi),
  ADD CONSTRAINT fk_solent_usu FOREIGN KEY (idusu) REFERENCES usuario(idusu),
  ADD CONSTRAINT fk_solent_usuapr FOREIGN KEY (idusu_apr) REFERENCES usuario(idusu);

ALTER TABLE solsalida
  ADD CONSTRAINT fk_solsal_emp FOREIGN KEY (idemp) REFERENCES empresa(idemp),
  ADD CONSTRAINT fk_solsal_ubi FOREIGN KEY (idubi) REFERENCES ubicacion(idubi),
  ADD CONSTRAINT fk_solsal_usu FOREIGN KEY (idusu) REFERENCES usuario(idusu),
  ADD CONSTRAINT fk_solsal_usuapr FOREIGN KEY (idusu_apr) REFERENCES usuario(idusu);

ALTER TABLE detentrada
  ADD CONSTRAINT fk_detent_emp FOREIGN KEY (idemp) REFERENCES empresa(idemp),
  ADD CONSTRAINT fk_detent_ids FOREIGN KEY (idsol) REFERENCES solentrada(idsol) ON DELETE CASCADE,
  ADD CONSTRAINT fk_detent_prod FOREIGN KEY (idprod) REFERENCES producto(idprod);

ALTER TABLE detsalida
  ADD CONSTRAINT fk_detsal_emp FOREIGN KEY (idemp) REFERENCES empresa(idemp),
  ADD CONSTRAINT fk_detsal_ids FOREIGN KEY (idsol) REFERENCES solsalida(idsol) ON DELETE CASCADE,
  ADD CONSTRAINT fk_detsal_prod FOREIGN KEY (idprod) REFERENCES producto(idprod);

ALTER TABLE valor ADD CONSTRAINT fkvldm FOREIGN KEY (iddom) REFERENCES dominio(iddom);
ALTER TABLE pagina ADD CONSTRAINT fkpgmo FOREIGN KEY (idmod) REFERENCES modulo(idmod);
ALTER TABLE pxp ADD CONSTRAINT fkpxpe FOREIGN KEY (idper) REFERENCES perfil(idper);
ALTER TABLE pxp ADD CONSTRAINT fkpxpg FOREIGN KEY (idpag) REFERENCES pagina(idpag);

ALTER TABLE auditoria ADD CONSTRAINT fkauem FOREIGN KEY (idemp) REFERENCES empresa(idemp);
ALTER TABLE auditoria ADD CONSTRAINT fkauus FOREIGN KEY (idusu) REFERENCES usuario(idusu);

ALTER TABLE lote ADD CONSTRAINT fk_lote_prod FOREIGN KEY (idprod) REFERENCES producto(idprod);

-- DATOS DE PRUEBA --

INSERT INTO perfil (codper, nomper, nivel) VALUES
('ADM', 'Administrador', 3),
('USR', 'Usuario', 2),
('CON', 'Consulta', 1),
('VEN', 'Vendedor', 2),
('BOD', 'Bodeguero', 1);

INSERT INTO usuario (nomusu, apeusu, tdousu, ndousu, celusu, emausu, pasusu, idper) VALUES
('Admin', 'Sistema', 'CC', '123456789', '3001234567', 'admin@gmail.com', '$2b$12$6oTkFgnxtIkSkZsTnjy5Zu3ydEEdgUUU9PA46z3DGljO3U2KPCclq', 1),
('Juan', 'Pérez', 'CC', '987654321', '3102345678', 'juan@example.com', '$2b$12$6oTkFgnxtIkSkZsTnjy5Zu3ydEEdgUUU9PA46z3DGljO3U2KPCclq', 2),
('María', 'Gómez', 'TI', '1122334455', '3203456789', 'maria@example.com', '$2b$12$6oTkFgnxtIkSkZsTnjy5Zu3ydEEdgUUU9PA46z3DGljO3U2KPCclq', 3),
('Pedro', 'Rodríguez', 'CC', '2233445566', '3009876543', 'pedro@example.com', '$2b$12$6oTkFgnxtIkSkZsTnjy5Zu3ydEEdgUUU9PA46z3DGljO3U2KPCclq', 4),
('Laura', 'Martínez', 'CE', '3344556677', '3158765432', 'laura@example.com', '$2b$12$6oTkFgnxtIkSkZsTnjy5Zu3ydEEdgUUU9PA46z3DGljO3U2KPCclq', 5);

INSERT INTO empresa (nomemp, razemp, nitemp, diremp, telemp, emaemp, idusu) VALUES
('TechSolutions SA', 'TechSolutions Sociedad Anónima', '123456789-1', 'Calle 123 #45-67, Bogotá', '6012345678', 'contacto@techsolutions.com', 1),
('DistriElectro', 'Distribuidora Electrónica Ltda', '987654321-1', 'Av. Principal 890, Medellín', '6045678901', 'ventas@distrielectro.com', 1),
('Ferretería El Tornillo', 'Ferretería El Tornillo SAS', '555444333-2', 'Cra. 45 #56-78, Cali', '6023456789', 'info@eltornillo.com', 2),
('Papelería Moderna', 'Papelería Moderna Ltda', '111222333-4', 'Av. Comercial 123, Medellín', '6056789012', 'contacto@papeleriamoderna.com', 3),
('Bodega Central', 'Bodega Central SAS', '999888777-5', 'Zona Industrial, Barranquilla', '6051234567', 'bodega@central.com', 4);

INSERT INTO ubicacion (nomubi, codubi, dirubi, depubi, ciuubi, idemp, idresp) VALUES
('Bodega Principal', 'BOD-01', 'Calle 123 #45-67', 'Bogotá DC', 'Bogotá', 1, 1),
('Centro de Distribución', 'BOD-02', 'Av. Industrial 789', 'Antioquia', 'Medellín', 2, 1),
('Almacén Cali', 'BOD-03', 'Cra. 45 #56-78', 'Valle', 'Cali', 3, 2),
('Depósito Medellín', 'BOD-04', 'Av. Comercial 123', 'Antioquia', 'Medellín', 4, 3),
('Bodega Barranquilla', 'BOD-05', 'Zona Industrial', 'Atlántico', 'Barranquilla', 5, 4);

INSERT INTO categoria (nomcat, descat, idemp) VALUES
('Electrónica', 'Dispositivos y componentes electrónicos', 1),
('Herramientas', 'Herramientas manuales y eléctricas', 1),
('Insumos', 'Materiales de oficina y limpieza', 2),
('Muebles', 'Mobiliario de oficina', 3),
('Repuestos', 'Repuestos industriales', 4);

INSERT INTO producto (tipo_inventario, codprod, nomprod, desprod, idcat, idemp, unimed, stkmin, stkmax) VALUES
(1, 'PROD-001', 'Laptop HP EliteBook', 'Laptop i7 16GB RAM 512GB SSD', 1, 1, 'UND', 5, 50),
(1, 'PROD-002', 'Taladro Inalámbrico', 'Taladro 20V con 2 baterías', 2, 1, 'UND', 10, 100),
(1, 'PROD-003', 'Resma Papel A4', 'Paquete 500 hojas 75g', 3, 2, 'UND', 20, 200),
(1, 'PROD-004', 'Silla Oficina', 'Silla ergonómica ejecutiva', 4, 3, 'UND', 5, 30),
(1, 'PROD-005', 'Filtro de Aire', 'Filtro para maquinaria industrial', 5, 4, 'UND', 2, 15);


INSERT INTO proveedor (idubi, tipoprov, nomprov, docprov, telprov, emaprov, dirprov, idemp) VALUES
(1, 'Jurídico', 'ElectroParts SA', '987654321-2', '6012345679', 'compras@electroparts.com', 'Calle 456 #78-90, Bogotá', 1),
(2, 'Jurídico', 'Papelería Moderna', '543216789-1', '6056789012', 'contacto@papeleriamoderna.com', 'Av. Comercial 123, Medellín', 2),
(3, 'Natural', 'Carlos Torres', '1122334455', '3101234567', 'carlos.torres@mail.com', 'Cra 10 #20-30, Cali', 3),
(4, 'Jurídico', 'Muebles S.A.S', '2233445566', '3159876543', 'ventas@muebles.com', 'Zona Industrial 45, Medellín', 4),
(5, 'Jurídico', 'Repuestos Industriales Ltda', '3344556677', '3009871234', 'contacto@repuestos.com', 'Av. 80 #45-67, Bogotá', 5);

INSERT INTO inventario (idemp, idprod, idubi, cant) VALUES
(1, 1, 1, 15),
(1, 2, 1, 30),
(2, 3, 2, 150),
(3, 4, 3, 12),
(4, 5, 4, 5);

INSERT INTO kardex (idemp, anio, mes, cerrado) VALUES
(1, 2024, 1, 1),
(2, 2024, 1, 0),
(3, 2024, 2, 0),
(4, 2024, 2, 1),
(5, 2024, 3, 0);

INSERT INTO movim (idemp, idkar, idprod, idubi, fecmov, tipmov, cantmov, valmov, costprom, docref, idusu) VALUES
(1, 1, 1, 1, '2024-01-15', 1, 5, 2500.00, 500.00, 'FACT-001', 1),
(1, 1, 2, 1, '2024-01-15', 1, 10, 2000.00, 200.00, 'FACT-001', 1),
(2, 2, 3, 2, '2024-01-18', 1, 50, 180.50, 3.61, 'FACT-002', 1),
(3, 3, 4, 3, '2024-02-05', 2, 3, 900.00, 300.00, 'FACT-003', 2),
(4, 4, 5, 4, '2024-02-10', 1, 7, 1400.00, 200.00, 'FACT-004', 3);

-- 1. Crear módulo Principal
INSERT INTO modulo (idmod, nommod, icono, ruta, orden, fec_crea, act)
VALUES 
(1, 'Principal', 'fa fa-layer-group', '#', 1, NOW(), 1);

-- 2. Crear páginas base y adicionales
INSERT INTO pagina (idpag, idmod, nompag, ruta, icono, orden, fec_crea, act)
VALUES 
(1001, 1, 'Empresas', 'views/vemp.php', 'fa fa-building', 1, NOW(), 1),
(1002, 1, 'Productos', 'views/vprod.php', 'fa fa-box', 2, NOW(), 1),
(1003, 1, 'Proveedores', 'views/vprov.php', 'fa fa-truck', 3, NOW(), 1),
(1004, 1, 'Usuarios Empresa', 'views/vusemp.php', 'fa fa-users', 4, NOW(), 1);

-- 3. Permisos para el perfil Administrador (idper=1)
INSERT INTO pxp (idper, idpag, ver, crear, editar, eliminar, fec_crea)
VALUES 
(1, 1001, 1, 1, 1, 1, NOW()),
(1, 1002, 1, 1, 1, 1, NOW()),
(1, 1003, 1, 1, 1, 1, NOW()),
(1, 1004, 1, 1, 1, 1, NOW());
