<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Expensescategory;
use app\models\ExpensescategorySearch;

class ExpensescategoryController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionExpensesCategory()
    {
        $expensescategorysearchModel = new ExpensescategorySearch();
        $expensescategorydataProvider = $expensescategorysearchModel->search($this->request->queryParams);
        $expensescategory = new Expensescategory();

        if ($expensescategory->load(Yii::$app->request->post()) && $expensescategory->validate()) {
            if ($expensescategory->createExpensesCategory()) {
                return $this->redirect('expenses-category');
            }
        }
        return $this->render('expensescategory',
            ['expensescategorysearchModel' => $expensescategorysearchModel,
                'expensescategorydataProvider' => $expensescategorydataProvider,
            ]);
    }

    public function actionNewExpensesCategory()
    {
        $expensescategory = new Expensescategory();

        if ($expensescategory->load(Yii::$app->request->post()) && $expensescategory->validate()) {
            if ($expensescategory->createNewExpensesCategory()) {
                Yii::$app->session->setFlash('EXPENSE(s) CATEGORY');
                return $this->redirect('expenses-category');
            }
        }

        return $this->render('newexpensescategory',
            ['expensescategory' => $expensescategory,]);
    }
    public function actionUpdate($id)
    {
        $expensescategory = Expensescategory::findOne($id);

        if ($expensescategory === null) {
            throw new \yii\web\NotFoundHttpException('The requested product does not exist.');
        }

        if ($expensescategory->load(Yii::$app->request->post())) {


            if ($expensescategory->createUpdate()) {
                Yii::$app->session->setFlash('EXPENSE(s) CATEGORY UPDATE');
                return $this->redirect(['view', 'id' => $expensescategory->id]);
            }
        }

        return $this->render('updateexpensescategory', ['expensescategory' => $expensescategory, 'id' => $id]);
    }

    public function actionView($id)
    {
        $expensescategory = Expensescategory::findOne($id);

        return $this->render('viewexpensescategory', ['expensescategory' => $expensescategory, 'id' => $id]);
    }

    public function actionDeletedItem()
    {
        $expensescategorysearchModel = new ExpensescategorySearch();
        $expensescategorydataProvider = $expensescategorysearchModel->filterDeleted($this->request->queryParams);


        return $this->render('deleted',
            ['expensescategorysearchModel' => $expensescategorysearchModel,
                'expensescategorydataProvider' =>   $expensescategorydataProvider
            ]);
    }

    public function actionDelete($id)
    {
        $expensescategory = Expensescategory::findOne($id);

        if ( $expensescategory->createsoftDelete()) {
            return $this->redirect(['deleted-item', 'id' =>  $expensescategory->id]);
        }
    }
    public function actionHardDelete()
    {
        $expensescategorys =Expensescategory::find()->where(['is_deleted' => 1])->all();

        foreach (  $expensescategorys as   $expensescategory) {
            $expensescategory->delete();
        }

        return $this->redirect("deleted-item");
    }
    public function actionPermanentlyDeleteItem($id)
    {
        $expensescategory=Expensescategory::findOne($id);
        $expensescategory->delete();
        return $this->redirect(['deleted-item', 'id' =>  $expensescategory->id]);
    }
    public function actionReversal($id)
    {
        $expensescategory = Expensescategory::findOne($id);

        if ( $expensescategory->createreverse()) {
            return $this->redirect(['expenses-category', 'id' =>  $expensescategory->id]);
        }
    }
}