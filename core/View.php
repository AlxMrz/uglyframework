<?php
namespace core;

/**
 * Description of View
 *
 * @author Alexandr
 */
class View
{
    protected $title;
    protected $assets;

    public function __construct()
    {
        $this->assets['global_assets'] = require 'config/assets.php';
    }
    /**
     * 
     * @param string $template
     * @param array $data
     */
    public function render($template,$data=[])
    {
        $content = $this->formTemplate($template,$data);
        require 'view/header.php';
        echo $content;
        require 'view/footer.php';
    }

    /**
     * Добавляет глобальные css файлы для сайта в тегах <header></header>
     */
    public function putGlobalCss()
    {
        foreach ($this->assets['global_assets']['css'] as $style) {
            echo "<link href='/assets/global/css/{$style}' rel='stylesheet' type='text/css' />";
        }
    }

    /**
     * Добавляет глобальные js файлы в конце страницы
     */
    public function putGlobalJs()
    {
        foreach ($this->assets['global_assets']['js'] as $script) {
            echo "<script src='/assets/global/js/{$script}'></script>";
        }
    }
    /**
     * 
     * @param string $cssFileName
     */
    public function addLocalCss($cssFileName)
    {
        echo "<link href='/assets/{$cssFileName}' rel='stylesheet' type='text/css' />";
    }
    /**
     * 
     * @param array $jsFileNames
     */
    public function addLocalJs($jsFileNames)
    {
        foreach ($jsFileNames as $jsFileName) {
            echo "<script src='/assets/{$jsFileName}'></script>";
        }
    }
    /**
     * Возвращает результат подключения шаблона.
     * @param string $template
     * @param mixed $data
     * @return string
     */
    protected function formTemplate($template,$data) {
     ob_start();
     require "view/{$template}.php";
     $content = ob_get_contents();
     ob_clean();
     return $content;
    }
    /**
     * Заголовок устанавливает в шаблоне перед выводом на экран.
     * @param string $title Заголовок страницы
     */
    public function setTitle($title) {
        $this->title = $title;
    }

}
