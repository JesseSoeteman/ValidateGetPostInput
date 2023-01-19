<?php

namespace ValidateGetPostInput\Statics;

abstract class RequestType
{
    const GET = 0;
    const POST = 1;
}

abstract class Pattern
{
    const NO_PATTERN = 0;
    const VALIDATE_EMAIL = 1;
    const REGEX = 2;
}