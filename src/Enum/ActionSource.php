<?php
declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Enum;

/**
 * @see https://developers.facebook.com/docs/marketing-api/conversions-api/parameters/server-event#action_source
 */
enum ActionSource: string
{
    case WEBSITE = 'website';
    case APP = 'app';
    case PHONE_CALL = 'phone_call';
    case CHAT = 'chat';
    case EMAIL = 'email';
    case SMS = 'sms';
    case IN_STORE = 'in_store';
    case SYSTEM_GENERATED = 'system_generated';
    case OTHER = 'other';
}
