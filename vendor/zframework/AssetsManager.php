<?php

/**
 * Date: 19/08/2015
 * Time: 13:36
 */

namespace zframework;

/**
 * Classe responsável pelo gerenciamento de arquivos do tipo .css, .js, imagens, etc.
 * @package zframework
 * @author José Carlos Gonçalves da Costa <josecarlosgdacosta@gmail.com>
 * @copyright Copyright (c) 2013-2014 José Carlos Gonçalves da Costa
 * @version v 1.0.0
 */
class AssetsManager
{
    /** @var string Armazena a pasta dos assets. */
    private $_assetsFolder = "../public/assets/";

    /**
     * Método responsável por retornar o caminho absoluto para a pasta dos assets.
     * @return string Caminho dos assets.
     */
    private function getBasePath()
    {
        $protocol = isset($_SERVER["https"]) ? 'https://' : 'http://';
        $projectNameDir = current(explode("/", ltrim($_SERVER["PHP_SELF"], "/")));
        return $protocol . $_SERVER['SERVER_NAME'] . "/" . $projectNameDir . '/public/assets/';
    }

    /**
     * Método que verifica se determinado asset existe.
     * @param string $file Endereço do arquivo dentro da pasta assets.
     * @return bool
     */
    private function assetExists($file)
    {
        if (file_exists($this->_assetsFolder.$file)) {
            return true;
        }

        return false;
    }

    /**
     * Método responsável por adicionar aquivos do tipo .css à view.
     * @param string $file Caminho do arquivo .css dentro da pasta assets.
     * @return string Tag html para inclusão de arquivos .css.
     */
    public function loadCssFile($file)
    {
        $cssFile = $this->getBasePath().$file;

        if ($this->assetExists($file)) {
            return "<link rel='stylesheet' href='{$cssFile}' />";
        }

        return false;
    }

    /**
     * Método responsável por adicionar arquivos do tipo .js à view.
     * @param string $file Caminho do arquivo .js dentro da pasta assets.
     * @return string Tag html para inclusão de arquivos .js.
     */
    public function loadJsFile($file)
    {
        $jsFile = $this->getBasePath().$file;

        if ($this->assetExists($file)) {
            return "<script src='{$jsFile}'></script>";
        }

        return false;
    }

    /**
     * Método responsável por adicionar imagens à view.
     * @param string $file Caminho da imagem dentro da pasta assets.
     * @param array $options Array com opções para a tag html.
     * @return string Tag html para inclusão de imagens.
     */
    public function loadImage($file, array $options)
    {
        if ($this->assetExists($file)) {

            $image = $this->getBasePath().$file;
            $id = isset($options["id"]) ? "id='".$options["id"]."'" : null ;
            $class = isset($options["class"]) ? "class='".$options["class"]."'" : null ;
            $alt = isset($options["alt"]) ? "alt='".$options["alt"]."'" : null ;
            $width = isset($options["width"]) ? "width='".$options["width"]."px'" : null ;
            $height = isset($options["height"]) ? "height='".$options["height"]."px'" : null ;

            return "<img src='{$image}' {$id} {$class} {$alt} {$width} {$height} />";
        }

        return false;

    }

}