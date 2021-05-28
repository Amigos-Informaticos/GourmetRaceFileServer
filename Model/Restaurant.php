<?php

namespace model;

use R;

class Restaurant
{
	private $name;
	private $locationURL;
	private $score;
	private $categories;
	private $claimed;
	private $serviceType;
	private $owner;
	
	public function __construct($name)
	{
		$this->name = $name;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getLocationURL()
	{
		return $this->locationURL;
	}
	
	public function setLocationURL($locationURL)
	{
		$this->locationURL = $locationURL;
	}
	
	public function getScore()
	{
		return $this->score;
	}
	
	public function setScore($score)
	{
		$this->score = $score;
	}
	
	public function getCategories()
	{
		return $this->categories;
	}
	
	public function setCategories($categories)
	{
		$this->categories = $categories;
	}
	
	public function addCategory($category)
	{
		$this->categories[] = $category;
	}
	
	public function getClaimed()
	{
		return $this->claimed;
	}
	
	public function setClaimed($claimed)
	{
		$this->claimed = $claimed;
	}
	
	public function getServiceType()
	{
		return $this->serviceType;
	}
	
	public function setServiceType($serviceType)
	{
		$this->serviceType = $serviceType;
	}
	
	public function addServiceType($serviceType)
	{
		$this->serviceType[] = $serviceType;
	}
	
	public function getOwner()
	{
		return $this->owner;
	}
	
	public function setOwner($owner)
	{
		$this->owner = $owner;
	}
	
	public function isComplete()
	{
		return
			isset($this->name) && !empty($this->name) &&
			isset($this->locationURL) && !empty($this->locationURL) &&
			isset($this->score) && !empty($this->score) &&
			isset($this->categories) && !empty($this->categories) &&
			isset($this->claimed) && !empty($this->claimed) &&
			isset($this->serviceType) && !empty($this->serviceType);
	}
	
	public function register()
	{
		$registered = false;
		if ($this->isComplete()) {
			$beanRestaurant = R::dispense("restaurant");
			$beanRestaurant->name = $this->name;
			$beanRestaurant->url = $this->locationURL;
			$beanRestaurant->claimed = $this->claimed;
			//$beanRestaurant->
		}
		return $registered;
	}
	
}