<?php

namespace UkraineAddresses\Base;

class Activator
{
    public function activate()
    {
        flush_rewrite_rules();
    }
}
