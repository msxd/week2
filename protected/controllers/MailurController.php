<?php

class MailurController extends Controller
{
	//return to main page(get)
	public function actionIndex()
	{
		$this->redirect(array('/site'));
	}

	//approve email (set)
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

	//pass recovery (set)
	public function actionCheck($url)
	{
		/** @var User $usr */
		$usr = User::model();
		$usr->changePass(true, $url);

		$this->redirect(array('/site'));
	}

	//password recovery(get)
	public function actionRecovery()
	{

		if (!Yii::app()->user->isGuest) {
			$this->redirect(Yii::app()->user->returnUrl);
		}

		$model = new User('passRecovery');
		/** @var User $model */
		if (isset($_POST['User']['email'])) {
			$model = User::model()->findByMail($_POST['User']['email'])->find();
			if (!$model) {
				$model = new User();
				$model->addError('email', 'Email address is incorrect');
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

}