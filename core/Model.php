<?php

class Model{
	
	protected $db;

	public function __construct(){
		global $db;

		$this->db = $db;
	}

    /**
     *
     * Exemplo
     *
     * $c->insert("tabela", ["indice"=> "valor", "indice2" => "valor2"]
     *
     *
     * @param $table string nome da tabela
     * @param $values array Exemplo: ["nome" => "teste"]
     * @return string | int
     */
    public function insert($table, $values) {

        try {

            $data = $this->arrayBinds($values);

            $stmt = $this->db->prepare("INSERT INTO {$table} {$data['columns']} VALUES {$data['bind']}");

            $stmt->execute($data['array']);
            return $this->db->lastInsertId();

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Usado no insert e update
     *
     * @param $values
     * @return string | array
     */
    private function arrayBinds($values) {
        try {
            $data = [
                "columns" => [],
                "bind" => [],
                "array_equal" => [],
                "array" => []
            ];

            foreach ($values as $i => $value) {
                $data['columns'][] = $i;
                $data['bind'][] = ":" . $i;

                $data['array'][":" . $i] = $value;
                $data['array_equal'][] = $i . " = ? ";
            }

            return [
                "columns" => "(" . implode(",", $data['columns']) . ")",
                "bind" => "(" . implode(",", $data['bind']) . ")",
                "array" => $data['array'],
                "array_equal" => $data['array_equal']
            ];

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     *
     * $c->select("tabela", "*", "coluna = ?", [5], "left join tabela i on i.coluna = t.coluna", "t.coluna ASC", 1)
     *
     * @param $table
     * @param string $columns
     * @param null $where
     * @param array $bind
     * @param null $options
     * @param null $order
     * @param null $limit
     * @return string
     */
    public function select(
        $table,
        $columns = "*",
        $where = null,
        $bind = [],
        $options = null,
        $order = null,
        $limit = null
    ) {

        try {

            $command = "SELECT {$columns} FROM {$table} {$options} ";

            if ($where != null) $command .= "WHERE " . $where;

            if ($order != null) $command .= " ORDER BY " . $order;

            if ($limit != null) $command .= " LIMIT " . $limit;

            $stmt = $this->db->prepare($command);

            if ($where != null) {
                foreach ($bind as $i => $b) {
                    $stmt->bindValue($i + 1, $b);
                }
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }

    }

    /**
     * $c->update("tabela", ["indice"=> "valor", "indice2" => "valor2"], "coluna = ? ", [5])
     *
     * @param $table
     * @param $values
     * @param $where
     * @param $bind
     * @return string
     */
    public function update(
        $table,
        $values,
        $where,
        $bind
    ) {
        try {
            $this->start();

            $param = $this->arrayBinds($values);

            $stmt = $this->db->prepare("UPDATE {$table} SET " . implode(",", $param['array_equal']) . " WHERE {$where}");

            $binds = array_merge($param['array'], $bind);

            $n = 1;
            foreach ($binds as $i => $b) {
                $stmt->bindValue($n, $b);
                $n++;
            }

            $stmt->execute();

            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }

    }

    /**
     *
     * $c->delete("tabela", "coluna = ?", [5]);
     *
     * @param $table
     * @param $where
     * @param $bind
     * @param null $options
     * @return string
     */
    public function delete($table, $where, $bind, $options = null) {
        try {

            $stmt = $this->db->prepare("DELETE FROM {$table} {$options} WHERE {$where}");
            foreach ($bind as $i => $v) {
                $stmt->bindParam($i + 1, $v);
            }
            $stmt->execute();

            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}