<?php

namespace Dyt\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DytUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
