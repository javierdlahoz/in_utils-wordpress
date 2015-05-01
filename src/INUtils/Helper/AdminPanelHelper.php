<?php
namespace INUtils\Helper;

use INUtils\Singleton\AbstractSingleton;

class AdminPanelHelper extends AbstractSingleton
{
    const SETTINGS_GENERAL_PAGE = "general";

    /**
     *
     * @var string
     */
    private $id;

    /**
     *
     * @var string
     */
    private $title;

    /**
     *
     * @param string $id
     * @param string $title
     */
    public function addSettingsTextField($id, $title){
        add_settings_field($id, $title,
            array(&$this, "callbackAction"), self::SETTINGS_GENERAL_PAGE,
            'default', array("id" => $id));
        register_setting(self::SETTINGS_GENERAL_PAGE, $id);
    }

    public function callbackAction($args){
        $html = "<input type='text' name='".$args['id']."'";
        $html .= " id='".$args['id']."'";
        $html .= " value='".get_option($args['id'])."' size=45>";
        echo $html;
    }

    /**
     *
     * @param string $id
     * @param string $title
     */
    public function addSettingsTextArea($id, $title){
        add_settings_field($id, $title,
            array(&$this, "callbackTextAreaAction"), self::SETTINGS_GENERAL_PAGE,
            'default', array("id" => $id));
        register_setting(self::SETTINGS_GENERAL_PAGE, $id);
    }

    public function callbackTextAreaAction($args){
        $html = "<textarea name='".$args['id']."'";
        $html .= " id='".$args['id']."' cols=45 rows=5>";
        $html .= get_option($args['id'])." </textarea>";
        echo $html;
    }

    /**
     *
     * @param string $optionId
     * @return mixed
     */
    public static function getOption($optionId){
        return get_option($optionId);
    }
}