<?php

class MailurController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionAprove($url = null)
	{
		/** @var User $usr */
		$usr = User::model();

		if ($url == null) {
			$this->render('aprove', array('model' => $usr->genAproveUrl(Yii::app()->user)));
		} else {
			if($usr->aproveMe($url))
				$this->render('aprove', array('model' => 'Thx u r aproved'));
		}
	}

	public function actionRecovery($mail=null)
	{
		if($mail){
			$model = User::model()->findByMail($mail)->findAll();
			$this->render('recover', array('recover' => $model));
		}else{
			$this->render('recover', array('recover' => 'form'));
		}
	}


}