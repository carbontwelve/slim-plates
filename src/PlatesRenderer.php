<?php

namespace Carbontwelve\SlimPlates;

use Carbontwelve\SlimPlates\Exceptions\TemplatePathNotExistException;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;

class PlatesRenderer
{
    /**
     * @var string
     */
    protected $templatePath;

    /**
     * @var string
     */
    protected $fileExtension;

    /**
     * @var Engine
     */
    private $engine;

    /**
     * PlatesRenderer constructor.
     *
     * @param string $templatePath
     * @param string $fileExtension
     *
     * @throws TemplatePathNotExistException
     */
    public function __construct($templatePath = '', $fileExtension = 'phtml')
    {
        if (!realpath($templatePath)) {
            throw new TemplatePathNotExistException('The template path ['.$templatePath.'] does not exist.');
        }

        $this->templatePath = $templatePath;
        $this->fileExtension = $fileExtension;

        $this->engine = new Engine($this->templatePath, $this->fileExtension);
    }

    /**
     * Render a plate template and return with a PSR-7 Response object.
     *
     * @param ResponseInterface $response
     * @param $template
     * @param array $data
     *
     * @return ResponseInterface
     */
    public function render(ResponseInterface $response, $template, array $data = [])
    {
        $response->getBody()->write($this->engine->render($template, $data));

        return $response;
    }

    /**
     * Share data to specific templates.
     *
     * @param array $data
     * @param array $templates
     */
    public function shareData(array $data, array $templates)
    {
        $this->engine->addData($data, $templates);
    }

    /**
     * Share data to all templates.
     *
     * @param array $data
     */
    public function globalData(array $data)
    {
        $this->engine->addData($data);
    }

    /**
     * @return Engine
     */
    public function getEngine()
    {
        return $this->engine;
    }
}
