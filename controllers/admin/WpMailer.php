<?php
/**
 * Created by Media-Store.net
 * User: Artur
 * Date: 18.05.2019
 * Time: 18:37
 */

namespace hrf\controllers\admin;


/**
 * Class WpMailer
 * @package hrf\controllers\admin
 */
class WpMailer {

	/**
	 * @var string|array
	 */
	private $to;

	/**
	 * @var string
	 */
	private $subject;

	/**
	 * @var string
	 */
	private $message;

	/**
	 * @var string|array
	 */
	private $headers;

	/**
	 * @var array
	 */
	private $attachments = [];

	/**
	 * @return string|array
	 */
	public function getTo() {
		return $this->to;
	}

	/**
	 * @param string|array $to
	 */
	public function setTo( $to ) {
		$this->to = $to;
	}

	/**
	 * @return string
	 */
	public function getSubject() {
		return $this->subject;
	}

	/**
	 * @param string $subject
	 */
	public function setSubject( $subject ) {
		$this->subject = $subject;
	}

	/**
	 * @return string
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * @param string $message
	 */
	public function setMessage( $message ) {
		$this->message = $message;
	}

	/**
	 * @return string|array
	 */
	public function getHeaders() {
		return $this->headers;
	}

	/**
	 * @param string|array $headers
	 */
	public function setHeaders( $headers ) {
		$this->headers = $headers;
	}

	/**
	 * @return array
	 */
	public function getAttachments() {
		return $this->attachments;
	}

	/**
	 * @param array $attachments
	 */
	public function setAttachments( $attachments ) {
		$this->attachments = $attachments;
	}


	/**
	 * @return bool
	 */
	public function send() {
		return wp_mail(
			$this->to,
			$this->subject,
			$this->message,
			$this->headers,
			$this->attachments
		);
	}

}
