<?php

declare(strict_types=1);

namespace Infobank\Core;

class Endpoints
{
    public function getAuthEndpoint(): string
    {
        return "/v1/auth/token";
    }

    public function getFileEndpoint(): string
    {
        return "/v1/file";
    }

    public function getFormEndpoint(): string
    {
        return "/v1/form";
    }

    public function getSendSmsEndpoint(): string
    {
        return "/v1/send/sms";
    }

    public function getSendMmsEndpoint(): string
    {
        return "/v1/send/mms";
    }

    public function getSendInterEndpoint(): string
    {
        return "/v1/send/international";
    }

    public function getSendRcsEndpoint(): string
    {
        return "/v1/send/rcs";
    }

    public function getSendAlimtalkEndpoint(): string
    {
        return "/v1/send/alimtalk";
    }

    public function getSendFriendtalkEndpoint(): string
    {
        return "/v1/send/friendtalk";
    }

    public function getSendBrandMessageEndpoint(): string
    {
        return "/v1/send/brandmessage";
    }


    public function getSendOmniEndpoint(): string
    {
        return "/v1/send/omni";
    }

    public function getReportPollingEndpoint(): string
    {
        return "/v1/report/polling";
    }

}