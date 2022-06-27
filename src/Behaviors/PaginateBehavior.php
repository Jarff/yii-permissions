<?php
use Softbox\Utils\PaginateOptions;

class PaginateBehavior extends CBehavior{
	
	private $owner;
	private $relations;
    private $filter = null;
    private $options = null;
	
	public function paginate(PaginateOptions $paginateOptions = null){
		$this->owner = $this->getOwner();
		
		if (is_subclass_of($this->owner,'CActiveRecord')){
			if($paginateOptions){
                $this->options = $paginateOptions;
            }else{
                $paginateOptions = new PaginateOptions();
                $this->options = $paginateOptions;
            }
            
            // return $this->owner->findAll();
            if($this->options->with){
                return $this->owner->with($this->options->with)->findAll([
                    'condition' => '1=1 '.$this->options->strSearch(),
                    'offset' => $this->options->offset(),
                    'limit' => $this->options->limit(),
                    'order' => $this->options->sort()
                ]);
            }else{
                return $this->owner->findAll([
                    'condition' => '1=1 '.$this->options->strSearch(),
                    'offset' => $this->options->offset(),
                    'limit' => $this->options->limit(),
                    'order' => $this->options->sort()
                ]);
            }
			
			// return $jsonDataSource;
		}
		return false;
	}
}

// class PaginateOptions{
//     private $rows = 50;
//     private $page = 1;
//     private $fields = '';
//     private $strSearch = '';
//     private $offset = '';
//     private $limit = '';
//     private $sortBy = '';
//     public $with = null;

//     public function with(String $option){
//         $this->with = $option;
//         return $this;
//     }
//     public function rows($_rows){
//         $this->rows = $_rows;
//         return $this;
//     }
//     public function page($_page){
//         $this->page = $_page;
//         return $this;
//     }
//     public function filter($_filter){
//         $q = '';
//         $search = $_filter;
//         if(!empty($search) && isset($search[0][2])){
//             $q = $search[0][2];
//             $fieldsArr = array();
//             foreach($search as $key => $val){
//                 if(is_array($val)){
//                     foreach($val as $k => $v){
//                         $fieldsArr[] = $val[0];
//                         break;
//                     } //end for
//                 } //end if
//             } //end for
                                        
//             $fields = implode(",", $fieldsArr);
//             $strSearch = "LOWER(CONCAT('".$search[2]."'))";
                
//             $this->fields = $fields;
//             $this->strSearch = $strSearch;
//         } //end if
//         if(!empty($search) && !empty($fields)){
//             $this->strSearch = ' AND '.$this->strSearch.' LIKE LOWER(\'%'.$q.'%\')';
//         } //end if
//         return $this;
//     }
//     public function strSearch(){
//         return $this->strSearch;
//     }
//     public function offset(){
//         if($this->page == 1){
//             $this->offset = 0;
//             // $this->limit = $this->rows;
//         }else{
//             $this->offset = ($this->page-1) * $this->rows;
//         }
//         return $this->offset;
//     }
//     public function limit(){
//         if($this->page == 1){
//             $this->limit = $this->rows;
//         }else{
//             $this->limit = $this->rows * $this->page;
//         }
//         return $this->limit;
//     }
//     public function sortBy($_sortBy, $selector = 'DESC'){
//         $this->sortBy = $_sortBy;
//         if(isset($this->sortBy[0]->selector) && !empty($this->sortBy[0]->selector)){
//             if(isset($this->sortBy[0]->desc) && !empty($this->sortBy[0]->desc)){ $dir = ' DESC'; }else{ $dir = ' ASC'; } //end if
//             $this->sortBy = $this->sortBy[0]->selector.$dir;
//         }else{
//             $this->sortBy .= ' '.$selector;
//         }
//         return $this;
//     }

//     public function sort(){
//         return $this->sortBy;
//     }
// }