<?php

namespace alpiiscky\multilang\components;

use alpiiscky\multilang\models\Language;
use yii\web\UrlManager;

class LangUrlManager extends UrlManager
{
    public function createUrl($params)
    {
        $default_lang = Language::getDefaultLang();

        if( isset($params['lang_id']) ){

            $lang = Language::findOne($params['lang_id']);
            if( $lang === null ){
                $lang = Language::getDefaultLang();
            }
            unset($params['lang_id']);
        } else {
            $lang = Language::getCurrent();
        }

        $url = parent::createUrl($params);

        //Добавляем к URL префикс - буквенный идентификатор языка
        if( $url == '/' ){
            return ($default_lang->id != $lang->id) ? '/'.$lang->url : '/';
        }else{
            return ($default_lang->id != $lang->id) ? '/'.$lang->url.$url : $url;
        }
    }
}