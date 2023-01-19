<?php

namespace ValidateGetPostInput\Statics;

abstract class DateFormat
{
    const NONE = 0;
    /**
     * @ const YYYY_MM_DD, YYYY-MM-DD, 'Y-m-d'
     */
    const YYYY_MM_DD = 'Y-m-d';
    /**
     * @ const YYYY_MM_DD_HH_MM_SS, YYYY-MM-DD HH:MM:SS, 'Y-m-d H:i:s'
     */
    const YYYY_MM_DD_HH_MM_SS = 'Y-m-d H:i:s';
    /**
     * @ const YYYY_MM_DD_HH_MM_SS_TZ, YYYY-MM-DD HH:MM:SS TZ, 'Y-m-d H:i:s T'
     */
    const YYYY_MM_DD_HH_MM_SS_TZ = 'Y-m-d H:i:s T';
    /**
     * @ const YYYY_MM_DD_HH_MM_SS_TZ_Z, YYYY-MM-DD HH:MM:SS TZ Z, 'Y-m-d H:i:s T Z'
     */
    const YYYY_MM_DD_HH_MM_SS_TZ_Z = 'Y-m-d H:i:s T Z';
}