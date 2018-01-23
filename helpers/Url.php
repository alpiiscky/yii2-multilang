<?php

namespace alpiiscky\multilang\helpers;

use alpiiscky\multilang\models\Language;
use yii\helpers\Url as MainUrl;

class Url extends MainUrl
{
    public static function toLang($url = '', $params)
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

        //$url = \Yii::$app->urlManager->createUrl($params);

        if( $url == '/' ){
            return ($default_lang->id != $lang->id) ? '/'.$lang->url : '/';
        }else{
            return ($default_lang->id != $lang->id) ? '/'.$lang->url.$url : $url;
        }
    }
}