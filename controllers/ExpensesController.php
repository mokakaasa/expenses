<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Expenses;
use app\models\Expensessearch;

class ExpensesController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionExpenses()
    {
        $expensessearchModel = new Expensessearch();
        $expensesdataProvider = $expensessearchModel->search(Yii::$app->request->queryParams);

        $expenses = new Expenses();


        if ($expenses->load(Yii::$app->request->post())) {
            if ($expenses->createExpense()) {
                return $this->redirect('expenses');
            }
        }

        return $this->render('expenses',
            ['expensesearchModel' => $expensessearchModel,
                'expensesdataProvider' => $expensesdataProvider]);
    }

    public function actionNewExpenses()
    {
        $expenses = new Expenses();

        if ($expenses->load(Yii::$app->request->post()) && $expenses->validate()) {
            if ($expenses->createNewExpenses()) {
                Yii::$app->session->setFlash('EXPENSES');
                return $this->redirect('expenses');
            }
        }
        return $this->render('newexpenses', ['expenses' => $expenses]);
    }

    public function actionViewExpenses($id)
    {
        $expensessearchModel = new ExpensesSearch();
        $expensesdataProvider = $expensessearchModel->viewExpenses($this->request->queryParams);

        return $this->render('viewexpenses',
            ['expensessearchModel' => $expensessearchModel,
                'expensesdataProvider' => $expensesdataProvider,
            ]);
    }

    public function actionView($id)
    {
        $expenses = Expenses::findOne($id);

        return $this->redirect(['view-expenses', 'id' => $expenses->id]);

    }
    public function actionUpdate($id)
    {
        $expenses = Expenses::findOne($id);

        if ($expenses->load(Yii::$app->request->post())) {
            if ($expenses->createUpdate()) {
                Yii::$app->session->setFlash('EXPENSE(s) UPDATE');
                return $this->redirect(['view', 'id' => $expenses->id]);
            }
        }
        return $this->render('updateexpenses', ['expenses' => $expenses]);
    }
    public function actionDeletedItem()
    {
        $expensessearchModel = new ExpensesSearch();
        $expensesdataProvider = $expensessearchModel->filterDeleted($this->request->queryParams);

        return $this->render('deleted',
            ['expensessearchModel' => $expensessearchModel,
                'expensesdataProvider' =>   $expensesdataProvider
            ]);
    }
    public function actionDelete($id)
    {
        $expenses = Expenses::findOne($id);

        if ( $expenses->createsoftDelete()) {
            return $this->redirect(['deleted-item', 'id' =>  $expenses->id]);
        }
    }
    public function actionHardDelete()
    {
        $expensess =Expenses::find()->where(['is_deleted' => 1])->all();

        foreach (  $expensess as   $expenses) {
            $expenses->delete();
        }

        return $this->redirect("deleted-item");
    }
    public function actionPermanentlyDeleteItem($id)
    {
        $expenses=Expenses::findOne($id);
        $expenses->delete();
        return $this->redirect(['deleted-item', 'id' =>  $expenses->id]);
    }
    public function actionReversal($id)
    {
        $expenses= Expenses::findOne($id);

        if ( $expenses->createreverse()) {
            return $this->redirect(['expenses', 'id' =>  $expenses->id]);
        }
    }
}