CREATE TABLE maestros (
  controlNumber VARCHAR(10) NOT NULL,
  nameMaestro TINYTEXT,
  lastNameMaestro TINYTEXT,
  email VARCHAR(80) UNIQUE,
  tipo_usuario TINYTEXT default 'Maestro',
  adminTeacherPwd TEXT,
  PRIMARY KEY (controlNumber)
);

CREATE TABLE asesoresInternos (
  idAsesorInt INT NOT NULL AUTO_INCREMENT,
  nameAsesorInt TINYTEXT,
  lastNameMaestro TINYTEXT,
  email VARCHAR(80) UNIQUE,
  contactNumber TINYTEXT,
  companyName VARCHAR(150),
  PRIMARY KEY (idAsesorInt)
);

CREATE TABLE alumnos (
  controlNumber VARCHAR(10) NOT NULL,
  userFirstName VARCHAR(80),
  lastName VARCHAR(80),
  career TINYTEXT,
  email VARCHAR(80) UNIQUE,
  userPassword TEXT,
  semestre INT,
  grupo CHAR,
  anteproyectoDoc MEDIUMTEXT,
  extAsesor VARCHAR(10),
  intAsesor INT,
  tipo_usuario TINYTEXT default 'User',
  PRIMARY KEY (controlNumber),
  FOREIGN KEY (extAsesor) REFERENCES maestros(controlNumber),
  FOREIGN KEY (intAsesor) REFERENCES asesoresInternos(idAsesorInt)
);

CREATE TABLE justificantes (
  idJustificante INT NOT NULL AUTO_INCREMENT,
  controlNumber VARCHAR(10),
  reason VARCHAR(100),
  JustiDay INT,
  JustiMonth INT,
  detailedInfo TEXT,
  fechaCreacion DATE,
  PRIMARY KEY (idJustificante),
  FOREIGN KEY (controlNumber) REFERENCES alumnos(controlNumber)
);


SELECT a.anteproyectoDoc, i.nombreAsesor, i.nameAsesorInt, i.lastNameMaestro, i.email, i.contactNumber, i.companyName, i.cargo, i.horasContacto, m.nameMaestro as name, m.lastNameMaestro as lastname , m.email as maestroEmail from alumnos a INNER JOIN asesoresinternos i ON a.intAsesor = i.idAsesorInt JOIN maestros m ON a.extAsesor = m.controlNumber where a.controlNumber = "166I0505" ;

SELECT a.anteproyectoDoc, i.nombreAsesor, i.nameAsesorInt, i.lastNameMaestro, i.email, i.contactNumber, i.companyName, i.cargo, i.horasContacto from alumnos a INNER JOIN asesoresinternos i ON a.intAsesor = i.idAsesorInt where a.controlNumber = '166I0505' ;

SELECT m.nameMaestro as name, m.lastNameMaestro as lastname , m.email as maestroEmail from alumnos a INNER JOIN maestros m ON a.extAsesor = m.controlNumber where a.controlNumber = '166I0505' ;