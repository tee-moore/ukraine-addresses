<?php

namespace UkraineAddresses\Base;

class Deactivator
{
    public function deactivate()
    {
        flush_rewrite_rules();
    }
}
