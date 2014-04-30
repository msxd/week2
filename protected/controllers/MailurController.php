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
		echo '132 = '.$usr->approved;
		if ($url == null) {
			$this->render('aprove', array('model' => 'Somthing went wrong try agin, or contact with administrator '.
										'<a href="mailto:'.Yii::app()->params['adminEmail'].'">'.Yii::app()->params['adminEmail'].'</a>'));
		} else {
			if ($usr->aproveMe($url))
				$this->render('aprove', array('model' => 'Thx u r aproved'));
		}
	}

	public function actionRecovery($mail = null)
	{
		if ($mail) {
			$model = User::model()->findByMail($mail)->findAll();
			$this->render('recover', array('recover' => $model));
		} else {
			$this->render('recover', array('recover' => 'form'));
		}
	}


}