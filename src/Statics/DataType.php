<?php

namespace ValidateGetPostInput\Statics;

abstract class DataType
{
    const STRING = 0;
    const INTEGER = 1;
    const FLOAT = 2;
    const BOOLEAN = 3;
    const JSON_OBJECT = 4;
    const DATE = 5;
}