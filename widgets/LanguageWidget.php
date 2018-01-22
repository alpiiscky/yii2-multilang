<?php

namespace alpiiscky\multilang\widgets;

use alpiiscky\multilang\models\Language;
use yii\base\Widget;


class LanguageWidget extends Widget
{
    public $view = 'view';

    public function run()
    {
        return $this->render($this->view, [
            'current' => Language::getCurrent(),
            'langs' => Language::find()->where('id != :current_id', [':current_id' => Language::getCurrent()->id])->all(),
        ]);
    }
}
