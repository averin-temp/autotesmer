<?php

namespace common\notifications\renderers;

interface NotificationRenderer
{
    public function html($params);
    public function email($params);


}