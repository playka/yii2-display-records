<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\Html;

class Record extends ActiveRecord
{
    public function getAllRecordsArray(){
        $rows = (new Query())
            ->select(['*'])
            ->from('record')
            ->all();
        return $rows;
    }
    
    public function updateRowById($data){
        $row = $this->findOne($data['id']);
        $html = new Html();
        $row->priority = $html->encode($data['priority']);
        $row->text = $html->encode($data['text']);
        return $row ->update();
    }
    
    public function deleteRowById($id){
        return $this->deleteAll("id = $id");
    }

    public function insertRow($data){
        $html = new Html();
        $this->priority = $html->encode($data['priority']);
        $this->text = $html->encode($data['text']);
        return $this ->insert();
    }
}