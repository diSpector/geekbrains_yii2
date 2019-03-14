<?php

namespace app\components\activity;


interface ActivitySearchInterface
{
    public function getDataProvider();
    public function getDataProviderWithQuery($queryArr);
}