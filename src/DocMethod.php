<?php

declare(strict_types=1);

namespace Koriym\PhpOntology;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlockFactory;
use ReflectionMethod;

final class DocMethod
{
    /** @readonly  */
    public string $name;

    /** @readonly */
    public string $title = '';

    /** @readonly */
    public string $description = '';

    /**
     * @var array<int, DocParam>
     * @readonly
     */
    public array $params;

    /** @var ReflectionMethod */
    private ReflectionMethod $method;

    public function __construct(ReflectionMethod $method)
    {
        $this->name = $method->name;
        $factory = DocBlockFactory::createInstance();
        $docComment = $method->getDocComment();
        $tagParams = null;
        if ($docComment) {
            $docblock = $factory->create($docComment);
            $this->title = $docblock->getSummary();
            $this->description = (string) $docblock->getDescription();
            /** @var  ?array<string, TagParam> $tagParams */
            $tagParams = $this->getTagParams($docblock);
        }

        $this->params = $this->getDocParams($method, $tagParams);
    }

    /**
     * @param array<string, TagParam>|null $tagParams
     *
     * @return array<int, DocParam>
     */
    private function getDocParams(ReflectionMethod $method, ?array $tagParams): array
    {
        $parameters = $method->getParameters();
        $docParams = [];
        foreach ($parameters as $parameter) {
            $name = $parameter->getName();
            $hasTagParam = $tagParams && isset($tagParams[$name]);
            $tagParam = $hasTagParam ? $tagParams[$name] : new TagParam('', '');
            $docParams[] = new DocParam($parameter, $tagParam);
        }

        return $docParams;
    }

    /**
     * @return array<string, TagParam>
     */
    private function getTagParams(DocBlock $docblock): array
    {
        $tagParams = [];
        $params = $docblock->getTagsByName('param');
        /** @var array<DocBlock\Tags\Param> $params */
        foreach ($params as $param) {
            $name = (string) $param->getVariableName();
            $tagParams[$name] = new TagParam((string) $param->getType(), (string) $param->getDescription());
        }

        return $tagParams;
    }
}
