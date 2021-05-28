<?php

namespace model;

use R;
use RedBeanPHP\RedException\SQL;
use Service\HTTPStatus;
use user\Commensal as CommensalStruct;
use util\ConnectionBuilder;
use util\Logger;
use util\Util;

class Commensal
{
	private $email;
	private $username;
	private $password;
	private $id;
	private $isOwner;
	const table = "commensal";
	
	public function __construct($username, $email, $password)
	{
		$this->username = $username;
		$this->email = $email;
		$this->password = $password;
		ConnectionBuilder::buildDBConnection();
	}
	
	public static function buildFromCommensalStruct(CommensalStruct $commensal)
	{
		$newCommensal = new Commensal($commensal->username, $commensal->email, $commensal->password);
		$newCommensal->isOwner = $commensal->isOwner;
		return $newCommensal;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	public function getUsername()
	{
		return $this->username;
	}
	
	public function setUsername($username)
	{
		$this->username = $username;
	}
	
	public function getPassword()
	{
		return $this->password;
	}
	
	public function setPassword($password)
	{
		$this->password = $password;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function getIsOwner()
	{
		return $this->isOwner;
	}
	
	public function setIsOwner($isOwner)
	{
		$this->isOwner = $isOwner;
		return $this;
	}
	
	public function register()
	{
		if ($this->isRegistered() == HTTPStatus::NOT_FOUND) {
			$beanCommensal = R::dispense('commensal');
			$beanCommensal->username = $this->username;
			$beanCommensal->email = $this->email;
			$beanCommensal->password = Util::crypt($this->password);
			$beanCommensal->status = 1;
			$beanCommensal->isOwner = false;
			try {
				$this->id = R::store($beanCommensal);
				$response = HTTPStatus::RESOURCE_CREATED;
			} catch (SQL $exception) {
				Logger::staticLog($exception);
				$response = HTTPStatus::INTERNAL_SERVER_ERROR;
			}
		} else {
			$response = HTTPStatus::CONFLICT;
		}
		return $response;
	}
	
	public function login()
	{
		$query = " email = ? AND password = ? AND status = 1";
		$values = [$this->email, Util::crypt($this->password)];
		$beanCommensal = R::findOne(self::table, $query, $values);
		if ($beanCommensal != null) {
			$this->id = $beanCommensal->getID();
			$this->username = $beanCommensal->getProperties()["username"];
			$this->email = $beanCommensal->getProperties()["email"];
			$this->password = $beanCommensal->getProperties()["password"];
			$response = HTTPStatus::OK;
		} else {
			$response = HTTPStatus::NOT_FOUND;
		}
		return $response;
	}
	
	public function isRegistered()
	{
		$query = " email = ?";
		$values = [$this->email];
		$beanCommensal = R::findOne(self::table, $query, $values);
		return $beanCommensal != null ? HTTPStatus::OK : HTTPStatus::NOT_FOUND;
	}
	
	public static function update(CommensalStruct $commensal)
	{
		$commensalModel = new Commensal(null, null, null);
		$commensalModel->setUsername($commensal->username);
		$commensalModel->setEmail($commensal->email);
		$commensalModel->setPassword($commensal->password);
		if ($commensalModel->isRegistered() == HTTPStatus::OK) {
			$query = " email = ?";
			$values = [$commensal->email];
			$beanCommensal = R::findOne(self::table, $query, $values);
			if ($beanCommensal != null) {
				$beanCommensal->username = $commensal->username;
				$beanCommensal->password = $commensal->password;
				try {
					R::store($beanCommensal);
					$returnValue = HTTPStatus::OK;
				} catch (SQL $exception) {
					Logger::staticLog($exception);
					$returnValue = HTTPStatus::INTERNAL_SERVER_ERROR;
				}
			} else {
				$returnValue = HTTPStatus::INTERNAL_SERVER_ERROR;
			}
		} else {
			$returnValue = HTTPStatus::NOT_FOUND;
		}
		return $returnValue;
	}
	
	public function delete()
	{
		$query = " email = ? AND password = ? AND status = 1";
		$values = [$this->email, Util::crypt($this->password)];
		$beanCommensal = R::findOne(self::table, $query, $values);
		if ($beanCommensal != null) {
			$beanCommensal->status = "0";
			try {
				R::store($beanCommensal);
				$response = HTTPStatus::OK;
			} catch (SQL $exception) {
				Logger::staticLog($exception);
				$response = HTTPStatus::INTERNAL_SERVER_ERROR;
			}
		} else {
			$response = HTTPStatus::NOT_FOUND;
		}
		return $response;
	}
	
	public static function getCommensalByEmail($email)
	{
		ConnectionBuilder::buildDBConnection();
		$commensal = null;
		$query = " email = ?";
		$values = [$email];
		$beanCommensal = R::findOne(self::table, $query, $values);
		if ($beanCommensal != null) {
			$commensal = new Commensal(null, null, null);
			$commensal->setUsername($beanCommensal->getProperties()["username"]);
			$commensal->setEmail($beanCommensal->getProperties()["email"]);
			$commensal->setPassword($beanCommensal->getProperties()["password"]);
		}
		return $commensal;
	}
}
