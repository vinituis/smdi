<?php

/**
 * Classe DB Refatorada para Interação Segura com Banco de Dados usando PDO.
 *
 * Utiliza Prepared Statements para prevenir SQL Injection.
 */
class DB {

    private static $pdo = null; // Mantém a conexão estática para reutilização (opcional)

    /**
     * Estabelece (ou retorna) uma conexão segura com o banco de dados usando PDO.
     * Configura atributos essenciais para segurança e tratamento de erros.
     *
     * @return PDO|false Retorna a instância PDO em caso de sucesso, ou false em caso de falha.
     */
    public static function connect() {
        // Se já temos uma conexão, retorna ela
        if (self::$pdo instanceof PDO) {
            return self::$pdo;
        }

        // Configurações - Mova para um arquivo de configuração em um app real
        $host = 'localhost';
        $user = 'root';
        $pass = '1234'; // Sua senha
        $base = 'smdi2025'; // Seu banco
        $charset = 'utf8mb4'; // UTF8MB4 é recomendado para suporte completo a unicode

        $dsn = "mysql:host={$host};dbname={$base};charset={$charset}";
        $options = [
            // Lança exceções em caso de erro (recomendado)
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            // Retorna resultados como objetos anônimos por padrão (era PDO::FETCH_OBJ)
            // Pode ser alterado para PDO::FETCH_ASSOC se preferir arrays associativos
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            // Desabilita a emulação de prepared statements (usa prepared statements nativos do DB)
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            self::$pdo = new PDO($dsn, $user, $pass, $options);
            return self::$pdo;
        } catch (PDOException $e) {
            // Em produção: logar o erro em vez de exibi-lo!
            error_log('DB Connection Error: ' . $e->getMessage());
            // Não exibir $e->getMessage() em produção
            // trigger_error('DB Connection Error: ' . $e->getMessage(), E_USER_ERROR);
            return false; // Falha na conexão
        }
    }

    /**
     * Executa uma consulta SQL SELECT e retorna múltiplos registros.
     *
     * @param string $table O nome da tabela (DEVE SER VALIDADO/CONFIÁVEL - não parametrizável).
     * @param array $conditions Condições e opções para a consulta:
     *   - 'select' => string (default '*'): Colunas a selecionar (DEVE SER VALIDADO/CONFIÁVEL). Ex: 'id, nome, email'.
     *   - 'where' => array []: Condições WHERE na forma ['coluna' => 'valor', 'outra_coluna' => 'outro_valor']. Usa AND. Valores serão parametrizados.
     *   - 'order_by' => string (default 'id DESC'): Cláusula ORDER BY (DEVE SER VALIDADO/CONFIÁVEL). Ex: 'nome ASC, data DESC'.
     *   - 'limit' => int: Número máximo de registros a retornar.
     *   - 'offset' => int: Número de registros a pular (para paginação).
     * @return array|false Retorna um array de objetos (ou definido por ATTR_DEFAULT_FETCH_MODE) ou false em caso de erro.
     */
    public static function getTodos($table, $conditions = []) {
        $pdo = self::connect();
        if (!$pdo) {
            return false;
        }

        // --- Validação/Sanitização de Inputs Não Parametrizáveis ---
        // Tabela: Permitir apenas caracteres alfanuméricos e underscore
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
             error_log("DB Error: Invalid table name provided: " . $table);
             return false;
        }
        // Select: Permitir '*', ou letras, números, underscore, vírgulas e espaços.
        // Uma validação mais robusta verificaria nomes de colunas reais.
        $select = $conditions['select'] ?? '*';
        if ($select !== '*' && !preg_match('/^[a-zA-Z0-9_,\s]+$/', $select)) {
             error_log("DB Error: Invalid select columns provided: " . $select);
             return false;
        }
         // Order By: Permitir letras, números, underscore, vírgulas, espaços e as palavras ASC/DESC.
         // !! ATENÇÃO: Ainda é recomendado validar contra colunas existentes se possível. !!
        $orderBy = $conditions['order_by'] ?? 'id DESC';
        if (!preg_match('/^[a-zA-Z0-9_,\s(ASC|DESC|asc|desc)]+$/i', $orderBy)) {
            error_log("DB Error: Invalid ORDER BY clause provided: " . $orderBy);
            return false;
        }
        // --- Fim Validação ---

        $sql = "SELECT {$select} FROM {$table}";
        $params = []; // Array para guardar os valores dos placeholders

        // Constrói a cláusula WHERE segura
        if (!empty($conditions['where']) && is_array($conditions['where'])) {
            $sql .= ' WHERE ';
            $whereClauses = [];
            foreach ($conditions['where'] as $key => $value) {
                // Valida o nome da coluna (chave) - simples, apenas alfanumérico/underscore
                if (!preg_match('/^[a-zA-Z0-9_]+$/', $key)) {
                     error_log("DB Error: Invalid column name in WHERE clause: " . $key);
                     return false;
                }
                $placeholder = ':' . $key; // Cria placeholder :nome_da_coluna
                $whereClauses[] = "`{$key}` = {$placeholder}"; // Usa backticks para nome da coluna
                $params[$placeholder] = $value; // Adiciona valor ao array de parâmetros
            }
            $sql .= implode(' AND ', $whereClauses);
        }

        // Adiciona ORDER BY validado
        $sql .= " ORDER BY {$orderBy}";

        // Adiciona LIMIT e OFFSET seguros (usando placeholders ou casting)
        // PDO pode lidar com placeholders no LIMIT/OFFSET em MySQL
        if (isset($conditions['limit'])) {
            $sql .= " LIMIT :limit";
            $params[':limit'] = (int) $conditions['limit']; // Garante que é inteiro
            if (isset($conditions['offset'])) {
                 $sql .= " OFFSET :offset";
                 $params[':offset'] = (int) $conditions['offset']; // Garante que é inteiro
            }
        }

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params); // Executa com os parâmetros seguros
            $results = $stmt->fetchAll(); // Usa o fetch mode padrão (FETCH_OBJ)
            // $rowCount = $stmt->rowCount(); // rowCount pode não ser confiável para SELECT em todos os drivers
            // Retornar apenas os resultados é geralmente mais útil
            return $results;
        } catch (PDOException $e) {
            error_log("DB getTodos Error [SQL: $sql]: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Executa uma consulta SQL SELECT e retorna um único registro.
     *
     * @param string $table O nome da tabela (VALIDADO/CONFIÁVEL).
     * @param array $conditions Condições e opções (veja getTodos). 'limit' é ignorado.
     * @return object|false Retorna um objeto (ou definido por ATTR_DEFAULT_FETCH_MODE) ou false se não encontrado ou em caso de erro.
     */
    public static function getUm($table, $conditions = []) {
        // Reutiliza a lógica de getTodos, mas força LIMIT 1 e retorna o primeiro item
        $conditions['limit'] = 1;
        unset($conditions['offset']); // Offset não faz sentido para buscar um

        $results = self::getTodos($table, $conditions);

        if ($results === false) {
            return false; // Erro na consulta getTodos
        }

        // Retorna o primeiro resultado, ou false se o array estiver vazio
        return $results[0] ?? false;
    }

    /**
     * Insere um novo registro em uma tabela.
     *
     * @param string $table O nome da tabela (VALIDADO/CONFIÁVEL).
     * @param array $data Um array associativo onde as chaves são os nomes das colunas
     *                    e os valores são os dados a serem inseridos.
     *                    Ex: ['nome' => 'Teste', 'email' => 'teste@example.com']
     * @return int|false Retorna o ID do último registro inserido em caso de sucesso, ou false em caso de erro.
     */
    public static function insert($table, $data) {
        $pdo = self::connect();
        if (!$pdo || empty($data) || !is_array($data)) {
            return false;
        }

         // Validação do nome da tabela
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            error_log("DB Error: Invalid table name provided for insert: " . $table);
            return false;
       }

        // Não adiciona timestamps automaticamente, confie nos defaults do DB
        // ou adicione-os ao array $data ANTES de chamar esta função se necessário.

        $columns = [];
        $placeholders = [];
        $params = [];

        foreach ($data as $key => $value) {
             // Valida nome da coluna
             if (!preg_match('/^[a-zA-Z0-9_]+$/', $key)) {
                 error_log("DB Error: Invalid column name in INSERT data: " . $key);
                 return false;
            }
            $columns[] = "`{$key}`"; // Usa backticks
            $placeholder = ':' . $key;
            $placeholders[] = $placeholder;
            $params[$placeholder] = $value;
        }

        $sql = "INSERT INTO {$table} (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $placeholders) . ")";

        try {
            $stmt = $pdo->prepare($sql);
            $success = $stmt->execute($params);
            return $success ? (int)$pdo->lastInsertId() : false;
        } catch (PDOException $e) {
            error_log("DB Insert Error [SQL: $sql]: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Atualiza registros existentes em uma tabela.
     *
     * @param string $table O nome da tabela (VALIDADO/CONFIÁVEL).
     * @param array $data Um array associativo com as colunas e novos valores a serem atualizados.
     * @param array $conditions Um array associativo para a cláusula WHERE ['coluna' => 'valor']. Usa AND.
     *                          !! IMPORTANTE: $conditions NÃO PODE estar vazio para segurança !!
     * @return int|false Retorna o número de linhas afetadas ou false em caso de erro ou se $conditions estiver vazio.
     */
    public static function update($table, $data, $conditions) {
        $pdo = self::connect();
        // Validações essenciais
        if (!$pdo || empty($data) || !is_array($data) || empty($conditions) || !is_array($conditions)) {
             if (empty($conditions)) error_log("DB Update Error: Conditions array cannot be empty for safety.");
             return false;
        }

        // Validação do nome da tabela
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            error_log("DB Error: Invalid table name provided for update: " . $table);
            return false;
        }

        // Não adiciona 'modified' automaticamente, confie no DB ou passe no array $data.

        $setClauses = [];
        $whereClauses = [];
        $params = [];

        // Prepara a parte SET
        foreach ($data as $key => $value) {
             // Valida nome da coluna
             if (!preg_match('/^[a-zA-Z0-9_]+$/', $key)) {
                 error_log("DB Error: Invalid column name in UPDATE data: " . $key);
                 return false;
            }
            $placeholder = ':set_' . $key; // Prefixo para evitar colisão com WHERE
            $setClauses[] = "`{$key}` = {$placeholder}";
            $params[$placeholder] = $value;
        }

        // Prepara a parte WHERE
        foreach ($conditions as $key => $value) {
             // Valida nome da coluna
             if (!preg_match('/^[a-zA-Z0-9_]+$/', $key)) {
                 error_log("DB Error: Invalid column name in UPDATE conditions: " . $key);
                 return false;
            }
            $placeholder = ':where_' . $key; // Prefixo para evitar colisão com SET
            $whereClauses[] = "`{$key}` = {$placeholder}";
            $params[$placeholder] = $value;
        }

        $sql = "UPDATE {$table} SET " . implode(', ', $setClauses) . " WHERE " . implode(' AND ', $whereClauses);

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->rowCount(); // Retorna o número de linhas afetadas
        } catch (PDOException $e) {
            error_log("DB Update Error [SQL: $sql]: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Deleta registros de uma tabela.
     *
     * @param string $table O nome da tabela (VALIDADO/CONFIÁVEL).
     * @param array $conditions Um array associativo para a cláusula WHERE ['coluna' => 'valor']. Usa AND.
     *                          !! IMPORTANTE: $conditions NÃO PODE estar vazio para segurança !!
     * @return int|false Retorna o número de linhas deletadas ou false em caso de erro ou se $conditions estiver vazio.
     */
    public static function delete($table, $conditions) {
         $pdo = self::connect();
         // Validações essenciais
         if (!$pdo || empty($conditions) || !is_array($conditions)) {
             if (empty($conditions)) error_log("DB Delete Error: Conditions array cannot be empty for safety.");
             return false;
         }

          // Validação do nome da tabela
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            error_log("DB Error: Invalid table name provided for delete: " . $table);
            return false;
        }

        $whereClauses = [];
        $params = [];

        // Prepara a parte WHERE
        foreach ($conditions as $key => $value) {
             // Valida nome da coluna
             if (!preg_match('/^[a-zA-Z0-9_]+$/', $key)) {
                 error_log("DB Error: Invalid column name in DELETE conditions: " . $key);
                 return false;
            }
            $placeholder = ':' . $key;
            $whereClauses[] = "`{$key}` = {$placeholder}";
            $params[$placeholder] = $value;
        }

        $sql = "DELETE FROM {$table} WHERE " . implode(' AND ', $whereClauses);

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->rowCount(); // Retorna o número de linhas deletadas
        } catch (PDOException $e) {
            error_log("DB Delete Error [SQL: $sql]: " . $e->getMessage());
            return false;
        }
    }

     /**
      * Método conveniente para executar queries raw que RETORNAM resultados (SELECT).
      * USA PREPARED STATEMENTS.
      *
      * @param string $sql A query SQL com placeholders (ex: SELECT * FROM users WHERE id = :id).
      * @param array $params Array associativo de parâmetros para bind (ex: [':id' => 123]).
      * @param int $fetchMode Modo de fetch do PDO (ex: PDO::FETCH_ASSOC, PDO::FETCH_OBJ). Default é o da conexão.
      * @param bool $fetchAll Se true, retorna todos os resultados (fetchAll), senão retorna um (fetch).
      * @return mixed Array de resultados, um único resultado, ou false em caso de erro.
      */
     public static function selectQuery($sql, $params = [], $fetchMode = null, $fetchAll = true) {
         $pdo = self::connect();
         if (!$pdo) {
             return false;
         }
         try {
             $stmt = $pdo->prepare($sql);
             $stmt->execute($params);

             $mode = $fetchMode ?? $pdo->getAttribute(PDO::ATTR_DEFAULT_FETCH_MODE);

             if ($fetchAll) {
                 return $stmt->fetchAll($mode);
             } else {
                 return $stmt->fetch($mode);
             }
         } catch (PDOException $e) {
             error_log("DB selectQuery Error [SQL: $sql]: " . $e->getMessage());
             return false;
         }
     }

    /**
      * Método conveniente para executar queries raw que NÃO RETORNAM resultados (INSERT, UPDATE, DELETE).
      * USA PREPARED STATEMENTS.
      *
      * @param string $sql A query SQL com placeholders (ex: UPDATE users SET name = :name WHERE id = :id).
      * @param array $params Array associativo de parâmetros para bind (ex: [':name' => 'John', ':id' => 123]).
      * @return int|false Retorna o número de linhas afetadas (para UPDATE/DELETE),
      *                   o lastInsertId (para INSERT se a query for INSERT),
      *                   ou false em caso de erro. Retorna 0 se nenhuma linha for afetada.
      */
     public static function executeQuery($sql, $params = []) {
         $pdo = self::connect();
         if (!$pdo) {
             return false;
         }
         try {
             $stmt = $pdo->prepare($sql);
             $stmt->execute($params);

             // Verifica se foi um INSERT para retornar lastInsertId
             if (stripos(trim($sql), 'INSERT') === 0) {
                 return (int)$pdo->lastInsertId();
             } else {
                 return $stmt->rowCount(); // Para UPDATE/DELETE
             }
         } catch (PDOException $e) {
             error_log("DB executeQuery Error [SQL: $sql]: " . $e->getMessage());
             return false;
         }
     }

} // Fim da classe DB