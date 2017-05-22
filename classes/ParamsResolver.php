<?php

namespace rusmd89\seo\classes;

use rusmd89\seo\classes\exceptions\NotFoundFileException;
use rusmd89\seo\classes\exceptions\NotFoundModelException;

class ParamsResolver
{
    /**
     * @var mixed
     */
    private $params;

    /**
     * @var array
     */
    private $resolvedParams = [];

    /**
     * ParamsResolver constructor.
     * @param $params
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Resolve params
     *
     * @param $params
     * @return $this
     */
    public function resolve($params)
    {
        foreach ($params as $name => $value) {
            if (array_key_exists($name, $this->params)) {
                $this->resolvedParams[$name] = $this->resolveParam(new $this->params[$name], $value);
            }
        }

        return $this;
    }

    /**
     * Resolve param
     *
     * @param $parameter RouteParameter
     * @param $value
     * @return \yii\db\ActiveRecord
     * @throws NotFoundModelException
     */
    protected function resolveParam(RouteParameter $parameter, $value)
    {
        $model = $parameter->getModel($value);
        if (empty($model)) {
            throw new NotFoundModelException();
        }

        return $model;
    }

    /**
     * @return array
     */
    public function getResolvedParams()
    {
        return $this->resolvedParams;
    }
}
