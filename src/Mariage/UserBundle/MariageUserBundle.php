<?php

namespace Mariage\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MariageUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
