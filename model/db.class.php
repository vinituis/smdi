<?php

class DB {
    public static function connect() {
        $host = 'localhost';
        $user = 'root';
        $pass = '1234';
        $base = 'smdi2025';

        // return new PDO("mysql:host={$host};dbname={$base};charset=UTF8;", $user, $pass);
        $db = new PDO("mysql:host={$host};dbname={$base};charset=UTF8;", $user, $pass);
        return $db;
    }

    public static function getTodos ($table, $conditions = array()) {
        $banco = DB::connect();
        $sql = 'SELECT ';
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
        $sql .= ' FROM '.$table;
        if(array_key_exists("where",$conditions)){
            $sql .= ' WHERE ';
            $i = 0;
            foreach($conditions['where'] as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $sql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        
        if(array_key_exists("order_by",$conditions)){
            $sql .= ' ORDER BY '.$conditions['order_by']; 
        }else{
            $sql .= ' ORDER BY id DESC '; 
        }
        
        if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit']; 
        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['limit']; 
        }

        // $sql = $db->prepare("INSERT INTO pagamento (modo, numeracao, empresa, cep, endereco, numero, complemento, bairro, cidade, estado, nome, email, telefone, quantidade, codigo, valor, status) VALUES ('$modo', '$numeracao', '$empresa', '$cep', '$endereco', '$numero', '$complemento', '$bairro', '$cidade', '$estado', '$respNome', '$respEmail', '$respTelefone', '$quantidade', '$cod', '$valor', 1)");
        // $sql->execute();


        $get = $banco->prepare("$sql");
        $get->execute();
        $result = $get->fetchAll(PDO::FETCH_OBJ);
        $rows = $get->rowCount();

        return array(
            'res' => $result,
            'row_count' => "$rows"
        );
    }

    public static function getUm ($table, $conditions = array()) {
        $banco = DB::connect();
        $sql = 'SELECT ';
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
        $sql .= ' FROM '.$table;
        if(array_key_exists("where",$conditions)){
            $sql .= ' WHERE ';
            $i = 0;
            foreach($conditions['where'] as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $sql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        
        if(array_key_exists("order_by",$conditions)){
            $sql .= ' ORDER BY '.$conditions['order_by']; 
        }else{
            $sql .= ' ORDER BY id DESC '; 
        }
        
        if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit']; 
        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['limit']; 
        }

        $get = $banco->prepare("$sql");
        $get->execute();
        $result = $get->fetchObject();

        return $result;
    }

    public static function insert($table, $data){
        $banco = DB::connect();
        if(!empty($data) && is_array($data)){
            $columns = '';
            $values  = '';
            $i = 0;
            if(!array_key_exists('created',$data)){
                $data['created'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists('modified',$data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $columns .= $pre.$key;
                $values  .= "$pre'$val'";
                $i++;
            }
            $query = "INSERT INTO ".$table." (".$columns.") VALUES (".$values.")";
            $query = $banco->prepare("$query");
            $insert = $query->execute();
            $lastId = $banco->lastInsertId();
            return array([
                'status' => "$insert",
                'last_id' => "$lastId",
            ]);
        }else{
            return false;
        }
    }

    public static function update($table, $data, $conditions){
        $banco = DB::connect();
        if(!empty($data) && is_array($data)){
            $colvalSet = '';
            $whereSql = '';
            $i = 0;
            if(!array_key_exists('modified',$data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $colvalSet .= $pre.$key." = '".$val."'";
                $i++;
            }
            if(!empty($conditions)&& is_array($conditions)){
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach($conditions as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $whereSql .= $pre.$key." = '".$value."'";
                    $i++;
                }
            }
            $query = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
            $query = $banco->prepare("$query");
            $update = $query->execute();
            $affectedRows = $query->rowCount();
            return array([
                'status' => "$update",
                'affected_rows' => "$affectedRows"

            ]);
        }else{
            return false;
        }
    }

    public static function delete($table, $conditions){
        $banco = DB::connect();
        $whereSql = '';
        if(!empty($conditions)&& is_array($conditions)){
            $whereSql .= ' WHERE ';
            $i = 0;
            foreach($conditions as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $whereSql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        $query = "DELETE FROM ".$table.$whereSql;
        $query = $banco->prepare("$query");
        $delete = $query->execute();
        return $delete?true:false;
    }

}