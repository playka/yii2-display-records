<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Record;
use yii\grid\GridView;
use yii\data\SqlDataProvider;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\db\Exception;
use yii\bootstrap\Alert;



class SiteController extends Controller
{
    public function actionIndex()
    {
        $pagination = new Pagination([
            'defaultPageSize' => 10,
        ]);

        $record = new Record();
        $rows = $record->getAllRecordsArray();
        
        return $this->render('index', [
            'records' => $rows,
            'pagination' => $pagination,
            'model' => $record
        ]);
    }
    
    public function actionEdit(){
        $request = Yii::$app->request;
        $model = new Record();
        if ($model->load($request->post()) && $request->isPost) {
            $data = $request->post('Record');
            switch ($request->post('button')){
                case ('add') :
                    try{
                        $model->insertRow($data);
                        $alert_text = 'Added successful!';
                        $alert_class = 'success';
                    } catch (Exception $e){
                        $alert_text = 'Smth went wrong:(';
                        $alert_class = 'danger';
                    }
                    break;
                case ('update') :
                try{
                    $model->updateRowById($data);
                    $alert_text = 'Updated successful!';
                    $alert_class = 'success';
                } catch (Exception $e){
                    $alert_text = 'Smth went wrong:(';
                    $alert_class = 'danger';
                }
                break;
                case ('delete') :
                    try{
                        $model->deleteRowById($data['id']);
                        $alert_text = 'Deleted successful!';
                        $alert_class = 'success';
                    } catch (Exception $e){
                        $alert_text = 'Smth went wrong:(';
                        $alert_class = 'danger';
                    }
                break;
                default:
                    break;
            }
            $alert = Alert::widget([
                'options' => [
                    'class' => "alert-$alert_class",
                ],
                'body' => $alert_text,
            ]);
            $session = Yii::$app->session;
            $session['alert'] = $alert;
            unset($_POST, $_GET);
            return $this->actionIndex();
        } else {
            $this->redirect('/');
        }
    }
}