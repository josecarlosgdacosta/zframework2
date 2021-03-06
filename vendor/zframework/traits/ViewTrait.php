<?php

/**
 * Date: 14/08/2015
 * Time: 15:00
 */

namespace zframework\traits;

use zframework\App;
use zframework\Layout;

/**
 * Trait responsável pelas operações com as views da aplicação.
 * @package zframework
 * @author José Carlos Gonçalves da Costa <josecarlosgdacosta@gmail.com>
 * @copyright Copyright (c) 2013-2014 José Carlos Gonçalves da Costa
 * @version v 1.0.0
 */
trait ViewTrait
{
    /** @var \stdClass Armazena o objeto da view. */
    protected $_view;

    /** @var string Armazena o título da view. */
    protected $_viewFileName;

    /** @var \zframework\Layout Armazena o objeto do layout. */
    protected $_layout;

    /**
     * Construtor padrão da classe.
     */
    public function __construct()
    {
        $this->_view = new \stdClass();
        $this->_app = new App();
    }

    /**
     * Método responsável por renderizar a view.
     * @param string $viewName Título da view.
     * @param Layout $layout Objeto com as opções de layout.
     */
    public function render($viewName, Layout $layout)
    {
        $this->_viewFileName = $viewName;
        $layoutFilePath = "../app/views/layout/layout.phtml";

        $this->_layout = $layout;

        if ($layout->getEnableLayout() && file_exists($layoutFilePath)) {
            require_once($layoutFilePath);
        } else {
            $this->getContent();
        }
    }

    /**
     * Método responsável por obter o conteúdo da view.
     */
    protected function getContent()
    {
        $fileNamePath = "../app/views/".$this->_viewFileName.".phtml";

        if (file_exists($fileNamePath)) {
            require_once($fileNamePath);
        } else {
            require_once ("../app/views/errors/404.phtml");
        }
    }

}

?>