<?php

namespace spec\AcfOowpBundle\Repository;

use Outlandish\AcfOowpBundle\Wrapper\Acf as AcfWrapper;
use Outlandish\AcfOowpBundle\Model\Acf As Model;
use Outlandish\SiteBundle\PostType\Article;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AcfSpec extends ObjectBehavior
{
    function let(AcfWrapper $acf)
    {
        $this->beConstructedWith($acf);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Outlandish\SiteBundle\Acf\AcfRepository');
    }

    function it_filters_the_results_of_a_field_by_id_key_and_id(AcfWrapper $acf)
    {
        $fieldKey = 'field_key';
        $postId = 12;
        $idKey = 'id';

        $row1 = ['id' => 'example'];
        $row2 = ['id' => 'example2'];

        $call = $acf->getField($fieldKey, $postId, true);
        $call->shouldBeCalled();
        $call->willReturn([$row1, $row2]);

        $this->fetch($fieldKey, $idKey, 'example', $postId)->shouldReturn($row1);
    }

    function it_defaults_the_post_id_to_options(AcfWrapper $acf)
    {
        $call = $acf->getField(Argument::any(), 'options', true);
        $call->shouldBeCalled();
        $call->willReturn([]);

        $this->fetch(Argument::any(), Argument::any(), Argument::any());
    }

    function it_defaults_the_format_to_true(AcfWrapper $acf)
    {
        $call = $acf->getField(Argument::any(), Argument::any(), true);
        $call->shouldBeCalled();
        $call->willReturn([]);

        $this->fetch(Argument::any(), Argument::any(), Argument::any());
    }

    function it_returns_null_if_the_acf_field_has_no_rows(AcfWrapper $acf)
    {
        $call = $acf->getField(Argument::cetera());
        $call->willReturn([]);

        $this->fetch(Argument::any(), Argument::any(), Argument::any())->shouldReturn(null);
    }

    function it_throws_an_exception_if_the_field_is_not_a_repeater(AcfWrapper $acf, Model $model)
    {
        $call = $acf->getField(Argument::cetera());
        $call->willReturn('a string');

        $this->shouldThrow('Outlandish\SiteBundle\Acf\Exception\NotRepeaterException')
            ->duringFetch(Argument::any(), Argument::any(), Argument::any());
        $this->shouldThrow('Outlandish\SiteBundle\Acf\Exception\NotRepeaterException')
            ->duringDelete(Argument::any(), Argument::any(), Argument::any());
        $this->shouldThrow('Outlandish\SiteBundle\Acf\Exception\NotRepeaterException')
            ->duringUpdate(Argument::any(), 'name', $model);
    }

    function it_throws_an_exception_if_the_fields_rows_do_not_contain_a_field_with_name_that_equals_id_key(AcfWrapper $acf, Model $model)
    {
        $row = ['bad_id' => null];
        $call = $acf->getField(Argument::cetera());
        $call->willReturn([$row]);

        $this->shouldThrow('Outlandish\SiteBundle\Acf\Exception\InvalidRepeaterFieldNameException')
            ->duringFetch(Argument::any(), 'id', Argument::any());
        $this->shouldThrow('Outlandish\SiteBundle\Acf\Exception\InvalidRepeaterFieldNameException')
            ->duringDelete(Argument::any(), 'id', 1);
        $this->shouldThrow('Outlandish\SiteBundle\Acf\Exception\InvalidRepeaterFieldNameException')
            ->duringUpdate(Argument::any(), 'id', $model);

    }

    function it_returns_null_if_id_does_not_exist_in_rows_of_field(AcfWrapper $acf)
    {
        $row1 = ['id' => 1];
        $row2 = ['id' => 2];

        $call = $acf->getField(Argument::cetera());
        $call->willReturn([$row1, $row2]);

        $this->fetch(Argument::any(), 'id', 3)->shouldReturn(null);
    }

    function it_deletes_a_row_from_a_field(AcfWrapper $acf)
    {
        $row1 = ['id' => 1];
        $row2 = ['id' => 2];

        $call = $acf->getField(Argument::any(), Argument::any());
        $call->shouldBeCalled();
        $call->willReturn([$row1, $row2]);

        $acf->updateField(Argument::any(), [$row1], Argument::any())->shouldBeCalled();

        $this->delete(Argument::any(), 'id', 2, Argument::any());
    }

    function it_defaults_post_id_to_options(AcfWrapper $acf)
    {
        $call = $acf->getField(Argument::any(), 'options');
        $call->shouldBeCalled();
        $call->willReturn([]);

        $this->delete(Argument::any(), Argument::any(), Argument::any());
    }

    function it_updates_a_row_within_a_repeater_field(AcfWrapper $acf, Model $model)
    {
        $row = ['name' => 'name', 'label' => 'Label'];
        $toArray = ['name' => 'name', 'label' => 'New Label'];

        $call = $model->toArray();
        $call->shouldBeCalled();
        $call->willReturn($toArray);

        $call = $acf->getField(Argument::cetera());
        $call->willReturn([$row]);

        $acf->updateField(Argument::any(), [$toArray], Argument::any())->shouldBeCalled();

        $this->update(Argument::any(), 'name', $model, Argument::any());
    }

    function it_sets_the_default_post_id_as_options_when_updating(AcfWrapper $acf, Model $model)
    {
        $call = $acf->getField(Argument::any(), 'options');
        $call->shouldBeCalled();
        $call->willReturn([]);

        $acf->updateField(Argument::any(), [], 'options')->shouldBeCalled();

        $this->update(Argument::any(), Argument::any(), $model);
    }

    function it_creates_a_new_article_type(AcfWrapper $acf, Model $model)
    {
        $name = 'name';
        $toArray = ['name' => $name];

        $call = $model->toArray();
        $call->shouldBeCalled();
        $call->willReturn($toArray);

        $call = $acf->getField(Argument::any(), 'options');
        $call->shouldBeCalled();
        $call->willReturn([]);

        $call = $acf->updateField(Argument::any(), [$toArray], 'options');
        $call->shouldBeCalled();
        $call->willReturn(true);

        $this->create(Argument::any(), $model, 'options')->shouldReturn(true);
    }
}
