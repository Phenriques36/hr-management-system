-- Tabela de utilizadores (para login)
CREATE TABLE IF NOT EXISTS utilizadores (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  email TEXT UNIQUE NOT NULL,
  password TEXT NOT NULL,
  tipo TEXT CHECK (tipo IN ('admin', 'gestor', 'funcionario')) NOT NULL
);

-- Tabela de funcionários
CREATE TABLE IF NOT EXISTS funcionarios (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  nome TEXT NOT NULL,
  telemovel TEXT,
  email TEXT,
  morada TEXT
);

-- Tabela de pedidos de férias
CREATE TABLE IF NOT EXISTS pedidos_ferias (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  id_funcionario INTEGER NOT NULL,
  data_inicio TEXT NOT NULL,
  data_fim TEXT NOT NULL,
  tipo TEXT NOT NULL,
  estado TEXT CHECK (estado IN ('pendente', 'aprovado', 'rejeitado')) DEFAULT 'pendente',
  FOREIGN KEY (id_funcionario) REFERENCES funcionarios(id)
);

-- Tabela de permissões
CREATE TABLE IF NOT EXISTS permissoes (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  id_utilizador INTEGER NOT NULL,
  modulo TEXT NOT NULL,
  nivel TEXT CHECK (nivel IN ('leitura', 'edição', 'admin')),
  FOREIGN KEY (id_utilizador) REFERENCES utilizadores(id)
);

-- Tabela de relatórios (opcional, para guardar histórico)
CREATE TABLE IF NOT EXISTS relatorios (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  titulo TEXT NOT NULL,
  tipo TEXT CHECK (tipo IN ('mensal', 'anual')),
  data_geracao TEXT DEFAULT CURRENT_TIMESTAMP,
  conteudo TEXT
);

ALTER TABLE utilizadores ADD COLUMN nome TEXT;