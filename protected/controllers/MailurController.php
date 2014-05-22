<?php

class MailurController extends Controller
{
	public function actionIndex()
	{
		$this->redirect(array('/site'));
	}

	public function actionAprove($url = null)
	{

		/** @var User $usr */
		$usr = User::model();
		if ($url == null) {
			$this->render('aprove', array('model' => 'Something went wrong try again or contact with administrator ' .
				'<a href="mailto:' . Yii::app()->params['adminEmail'] . '">' . Yii::app()->params['adminEmail'] . '</a>'));
		} else {
			if ($usr->aproveMe($url))
				$this->redirect(array('/site'));
		}
	}

	public function actionRecovery()
	{
		$model = new User('passRecovery');
		/** @var User $model */
		if (isset($_POST['User']['email'])) {
			$model = User::model()->findByMail($_POST['User']['email'])->find();
			if (!$model) {
				$model = new User();
				$model->addError('email','Email address is incorrect');
				$this->render('recover', array('model' => $model));

			} else {
				if ($model->passRecovery()) {
					$this->redirect(array('/site'));
				} else {
					$this->render('recover', array('model' => $model));
				}
			}
		} else {
			$this->render('recover', array('model' => $model));
		}
	}

	/** @var User $usr */
	public function actionCheck($url)
	{
		$datas = explode(':', base64_decode($url));
		if (count($datas) == 6) {
			/** @var User $usr */
			$usr = User::model();
			$usr->changePass(true, $url);
		}
		$this->redirect(array('/site'));
	}
}