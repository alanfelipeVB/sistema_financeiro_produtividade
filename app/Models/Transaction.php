<?php

class Transaction extends Model
{
    protected static $table = 'TRANSACAO';

    public function somaValue($data)
    {
        if($data['pago_recebido'] == 0){
            return;
        }
        $db = Database::getConnection();
        if ($data['tipo'] === 'receita') {
            $stmt = $db->prepare("UPDATE conta SET saldo = saldo + :valor WHERE id = :conta_id");
        } else {
            $stmt = $db->prepare("UPDATE conta SET saldo = saldo - :valor WHERE id = :conta_id");
        }
        $stmt->bindValue(':valor', $data['valor']);
        $stmt->bindValue(':conta_id', $data['conta_id']);
        $stmt->execute();
    }

    public static function adicionaNaConta($conta_id, $valor) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE conta SET saldo = saldo + :valor WHERE id = :conta_id");
        $stmt->bindValue(':valor', $valor);
        $stmt->bindValue(':conta_id', $conta_id);
        $stmt->execute();
    }

    public static function subtraiDaConta($conta_id, $valor) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE conta SET saldo = saldo - :valor WHERE id = :conta_id");
        $stmt->bindValue(':valor', $valor);
        $stmt->bindValue(':conta_id', $conta_id);
        $stmt->execute();
    }


    public static function getTableByUserId($userId)
    {
        $db = Database::getConnection();

        $sql = "
            SELECT 
                t.*, 
                c.nome AS conta_nome,
                cat.nome AS categoria_nome
            FROM TRANSACAO t
            LEFT JOIN CONTA c 
                ON t.conta_id = c.id
            LEFT JOIN CATEGORIA cat
                ON t.categoria_id = cat.id
            WHERE t.usuario_id = :user_id
            ORDER BY t.data_transacao DESC, t.id DESC
        ";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM " . static::$table . " WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function deleteById($id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM transacao WHERE id = :id");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}

