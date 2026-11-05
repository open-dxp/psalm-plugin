<?php

use OpenDxp\Tool\Serialize;

function serialized(): mixed
{
    return Serialize::unserialize($_GET['data']);
}
