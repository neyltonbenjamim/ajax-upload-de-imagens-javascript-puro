<?php

/**
 * Description of getImage
 *
 * @author Neylton
 */
class userImages extends model{

    public function insert($Title, $Keywords, $Data, $Nome){
        $sql = "INSERT INTO imagem (title,keywords,img_src,img_nome,img_data) VALUES (:title,:keywords,:src,:nome,:data)";
        $sql = parent::getConn()->prepare($sql);
        $sql->bindValue(':title',$Title);
        $sql->bindValue(':keywords',$Keywords);
        $sql->bindValue(':src',$Data);
        $sql->bindValue(':nome',$Nome);
        $sql->bindValue(':data',date('Y-m-d'));
        $sql->execute();

    }

    public function read($Offset,$Limit){
        $sql = "SELECT * FROM imagem ORDER BY id DESC LIMIT :offset,:limit";
        $sql = parent::getConn()->prepare($sql);
        $sql->bindValue(':offset',$Offset,PDO::PARAM_INT);
        $sql->bindValue(':limit',$Limit,PDO::PARAM_INT);
        $sql->execute();
        if($sql->rowCount()){
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }
}