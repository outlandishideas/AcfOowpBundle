<?php

namespace spec\Outlandish\AcfOowpBundle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OutlandishAcfOowpBundleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Outlandish\SiteBundle\OutlandishAcfOowpBundle');
    }
}
