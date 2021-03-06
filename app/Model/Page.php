<?php

namespace App\Model;

use \App\Libs\Model;

class Page extends Model{


    public static function findBySlug($slug){

        $page = self::where('slug',$slug)->get()->first();

        if($page!=NULL){
            return $page;
        }else{

            foreach (self::where('slug',NULL)->orWhere('slug',"")->get() as $page) {
                if(str_slug($page->name)==$slug){
                    return $page;
                }
            }

        }

        return NULL;
    }


    public function parent(){
        return $this->belongsTo(self::class,'parent_id','id');
    }


    public function subpages(){
        return $this->hasMany(self::class,'parent_id','id');
    }


   	public function getThumb(){

        if(file_exists("storage/images/pages/thumbs/".$this->image) && $this->image!=""){
            return url("storage/images/pages/thumbs/".$this->image);
        }else{
            return $this->getImage();
        }

	}

    public function getImage(){

    	if(file_exists("storage/images/pages/".$this->image) && $this->image!=""){
    		return url("storage/images/pages/".$this->image);
    	}else{
    		return url("resources/images/icons/page.png");
    	}

    }
}
