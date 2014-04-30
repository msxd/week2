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
			/** */
			/** @var PHPMailer $mail */
			/*
				$mail = new PHPMailer;
				$mail->From = 'from@example.com';
				$mail->FromName = 'Mailer';
				$mail->addAddress('valikov.ids@gmail.com', 'Alexander Valikov');  // Add a recipient
				//$mail->addCC('cc@example.com');
				//$mail->addBCC('bcc@example.com');

				$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
				//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
				//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
				$mail->isHTML(true);                                  // Set email format to HTML

				$mail->Subject = 'Here is the subject';
				$mail->Body = 'This is the HTML message body <b>in bold!</b>';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

				if (!$mail->send()) {
					echo 'Message could not be sent.';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
					exit;
				}

				echo 'Message has been sent';
*/
			$mail = new YiiMailer();
			$mail->setData(array('message' => 'Message to send', 'name' => 'John Doe', 'description' => 'Contact form'));
			$mail->setLayout('layoutName');
			$mail->setFrom('from@example.com', 'John Doe');
			//$mail->setTo(Yii::app()->params['adminEmail']);
			$mail->setTo('valikov.ids@gmail.com');
			$mail->setSubject('Mail subject');
			if ($mail->send()) {
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
			} else {
				Yii::app()->user->setFlash('error','Error while sending email: '.$mail->getError());
			}
			/** */
			$this->render('aprove', array('model' => $usr->genAproveUrl(Yii::app()->user)));
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