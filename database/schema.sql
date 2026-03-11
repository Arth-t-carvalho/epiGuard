SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS epi_guard DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE epi_guard ;

-- -----------------------------------------------------
-- 1. Cursos
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS epi_guard.cursos (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  sigla VARCHAR(10) NULL DEFAULT NULL,
  status ENUM('ATIVO', 'INATIVO') NOT NULL DEFAULT 'ATIVO',
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  atualizado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4;

-- -----------------------------------------------------
-- 2. Alunos
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS epi_guard.alunos (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  curso_id INT(11) NULL DEFAULT NULL,
  turno ENUM('MANHA', 'TARDE', 'NOITE', 'INTEGRAL') NULL DEFAULT NULL,
  caminho_foto_referencia VARCHAR(255) NULL DEFAULT NULL COMMENT 'URL ou path da imagem, evitar BLOB',
  status ENUM('ATIVO', 'INATIVO', 'TRANCADO') NOT NULL DEFAULT 'ATIVO',
  status_epi ENUM('CONFORME', 'NAO_CONFORME') NOT NULL DEFAULT 'CONFORME',
  ultima_atualizacao_status DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  atualizado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  INDEX (curso_id ASC),
  CONSTRAINT fk_alunos_curso FOREIGN KEY (curso_id) REFERENCES epi_guard.cursos (id) ON DELETE SET NULL
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4;

-- -----------------------------------------------------
-- 3. EPIs
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS epi_guard.epis (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nome VARCHAR(50) NOT NULL,
  status ENUM('ATIVO', 'INATIVO') NOT NULL DEFAULT 'ATIVO',
  PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4;

-- -----------------------------------------------------
-- 4. Ocorrências
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS epi_guard.ocorrencias (
  id INT(11) NOT NULL AUTO_INCREMENT,
  aluno_id INT(11) NOT NULL,
  data_hora DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  tipo ENUM('INFRACAO', 'CONFORMIDADE') NOT NULL DEFAULT 'INFRACAO',
  oculto BOOLEAN NOT NULL DEFAULT FALSE,
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  INDEX (aluno_id ASC),
  CONSTRAINT fk_ocorrencias_aluno FOREIGN KEY (aluno_id) REFERENCES epi_guard.alunos (id) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4;

-- -----------------------------------------------------
-- 5. Ocorrencia_EPIs (Tabela de Ligação N:N)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS epi_guard.ocorrencia_epis (
  id INT(11) NOT NULL AUTO_INCREMENT,
  ocorrencia_id INT(11) NOT NULL,
  epi_id INT(11) NOT NULL,
  PRIMARY KEY (id),
  INDEX (ocorrencia_id ASC),
  INDEX (epi_id ASC),
  CONSTRAINT fk_ocorrencia_epis_ocorrencia FOREIGN KEY (ocorrencia_id) REFERENCES epi_guard.ocorrencias (id) ON DELETE CASCADE,
  CONSTRAINT fk_ocorrencia_epis_epi FOREIGN KEY (epi_id) REFERENCES epi_guard.epis (id) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4;

-- -----------------------------------------------------
-- 6. Usuários
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS epi_guard.usuarios (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  usuario VARCHAR(50) NOT NULL,
  senha VARCHAR(255) NOT NULL COMMENT 'Armazenar como HASH (Bcrypt/Argon2)',
  cargo ENUM('SUPER_ADMIN', 'SUPERVISOR', 'PROFESSOR') NOT NULL,
  turno ENUM('MANHA', 'TARDE', 'NOITE', 'INTEGRAL') NULL DEFAULT NULL,
  curso_id INT(11) NULL DEFAULT NULL,
  status ENUM('ATIVO', 'INATIVO') NOT NULL DEFAULT 'ATIVO',
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE INDEX (usuario ASC),
  INDEX (curso_id ASC),
  CONSTRAINT fk_usuario_curso FOREIGN KEY (curso_id) REFERENCES epi_guard.cursos (id) ON DELETE SET NULL
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4;

-- -----------------------------------------------------
-- 7. Ações Ocorrência
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS epi_guard.acoes_ocorrencia (
  id INT(11) NOT NULL AUTO_INCREMENT,
  ocorrencia_id INT(11) NOT NULL,
  usuario_id INT(11) NOT NULL,
  tipo ENUM('OBSERVACAO', 'ADVERTENCIA_VERBAL', 'ADVERTENCIA_ESCRITA', 'SUSPENSAO') NOT NULL,
  observacao TEXT NULL DEFAULT NULL,
  data_hora DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  INDEX (ocorrencia_id ASC),
  INDEX (usuario_id ASC),
  CONSTRAINT fk_acoes_ocorrencia FOREIGN KEY (ocorrencia_id) REFERENCES epi_guard.ocorrencias (id) ON DELETE CASCADE,
  CONSTRAINT fk_acoes_usuario FOREIGN KEY (usuario_id) REFERENCES epi_guard.usuarios (id) ON DELETE RESTRICT
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4;

-- -----------------------------------------------------
-- 8. Amostras Facial
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS epi_guard.amostras_facial (
  id INT(11) NOT NULL AUTO_INCREMENT,
  aluno_id INT(11) NOT NULL,
  caminho_imagem VARCHAR(255) NOT NULL COMMENT 'Caminho da imagem',
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  INDEX (aluno_id ASC),
  CONSTRAINT fk_amostras_aluno FOREIGN KEY (aluno_id) REFERENCES epi_guard.alunos (id) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4;

-- -----------------------------------------------------
-- 9. Evidências
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS epi_guard.evidencias (
  id INT(11) NOT NULL AUTO_INCREMENT,
  ocorrencia_id INT(11) NOT NULL,
  caminho_imagem VARCHAR(255) NOT NULL COMMENT 'Caminho da imagem',
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  INDEX (ocorrencia_id ASC),
  CONSTRAINT fk_evidencias_ocorrencia FOREIGN KEY (ocorrencia_id) REFERENCES epi_guard.ocorrencias (id) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
