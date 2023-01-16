<?php
namespace common\interfaces;

interface OauthInterface
{
    public function authorizationUrl($backRef);
    public function authorize($code, $redirectUri);
    public function getUid();
    public function method($methodName);
    public function getInfo();
}