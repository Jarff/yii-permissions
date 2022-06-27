<?php
class ArrayBehavior extends CBehavior{
	
	private $owner;
	private $relations;
	
	public function toArray(){
		$this->owner = $this->getOwner();
		
		if (is_subclass_of($this->owner,'CActiveRecord')){
			
			$attributes = $this->owner->getAttributes();
			$this->relations 	= $this->getRelated();
			
			// $jsonDataSource = array('jsonDataSource'=>array('attributes'=>$attributes,'relations'=>$this->relations));
			$jsonDataSource = array_merge($attributes, $this->relations);
			// $jsonDataSource = ['attributes'=>$attributes,'relations'=>$this->relations];
			
			return $jsonDataSource;
		}
		return false;
	}
	private function getRelated()
	{	
		$related = array();
		
		$obj = null;
		
		$md=$this->owner->getMetaData();
		
		foreach($md->relations as $name=>$relation){
			
			$obj = $this->owner->getRelated($name);
			
			$related[$name] = $obj instanceof CActiveRecord ? $obj->getAttributes() : CJSON::encode($obj);
		}
	    
	    return $related;
	}
}