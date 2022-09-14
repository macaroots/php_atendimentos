--
-- Table structure for table atendimentos
--

DROP TABLE IF EXISTS setores;
CREATE TABLE setores (
  id int NOT NULL AUTO_INCREMENT,
  nome varchar(45) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=11;

--
-- Dumping data for table setores
--

LOCK TABLES setores WRITE;
/*!40000 ALTER TABLE setores DISABLE KEYS */;
INSERT INTO setores VALUES (2,'Admin'),(3,'TI'),(8,'Novo'),(10,'a');
/*!40000 ALTER TABLE setores ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS atendimentos;
CREATE TABLE atendimentos (
  id int NOT NULL AUTO_INCREMENT,
  nome varchar(45) DEFAULT NULL,
  data datetime DEFAULT NULL,
  id_setor int DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id_setor) REFERENCES setores (id)
) ENGINE=InnoDB AUTO_INCREMENT=2 ;
--
-- Dumping data for table atendimentos
--

LOCK TABLES atendimentos WRITE;
/*!40000 ALTER TABLE atendimentos DISABLE KEYS */;
/*!40000 ALTER TABLE atendimentos ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table setores
--
