<?php

namespace Outlandish\AcfOowpBundle\Wrapper;

/**
 * Wraps the functions for Advanced Custom Fields
 *
 * These functions are being wrapped to create more readable code
 * and to the mocking and stubbing of these functions when
 * testing methods that use these functions.
 *
 * Class Acf
 * @package Outlandish\AcfOowpBundle\Wrapper
 */
class Acf
{
    /**
     * Wraps the get_field() function for Advanced Custom Fields
     *
     * @param string          $fieldKey  The name of the field to be retrieved. eg “page_content”
     * @param null|int|string $postId    Specific post ID where your value was entered. Defaults to current post ID
     * @param bool            $format    Whether or not to format the value loaded from the db
     *
     * @return mixed
     */
    public function getField($fieldKey, $postId = null, $format = true)
    {
        return get_field($fieldKey, $postId, $format);
    }

    /**
     * Wraps the the_field() function for Advanced Custom Fields
     *
     * @param string   $fieldName
     * @param null|int $postId
     */
    public function theField($fieldName, $postId = null)
    {
        the_field($fieldName, $postId);
    }

    /**
     * Wraps the get_field_object() function for Advanced Custom Fields
     *
     * @param string   $fieldKey
     * @param null|int $postId
     * @param array    $options
     *
     * @return array|bool|mixed|void
     */
    public function getFieldObject($fieldKey, $postId = null, $options = array())
    {
        return get_field_object($fieldKey, $postId, $options);
    }

    /**
     * Wraps the get_sub_field() function for Advanced Custom Fields
     *
     * @param string $fieldName
     *
     * @return bool
     */
    public function getSubField($fieldName)
    {
        return get_sub_field($fieldName);
    }

    /**
     * Wraps the update_field() function for Advanced Custom Fields
     *
     * @param string   $fieldKey
     * @param mixed    $value
     * @param null|int $postId   Specific post ID where your value was entered. Defaults to current post ID
     *
     * @return bool
     */
    public function updateField($fieldKey, $value, $postId = null)
    {
        return update_field($fieldKey, $value, $postId);
    }

    /**
     * Wraps the get_fields() function for Advanced Custom Fields
     *
     * @param int|null $postId Specific post ID where your value was entered. Defaults to current post ID
     * @param bool     $format Whether or not to format the value loaded from the db
     *
     * @return array|bool
     */
    public function getFields($postId = null, $format = true)
    {
        return get_fields($postId, $format);
    }

    /**
     * Wraps the the_repeater_field() function for Advanced Custom Fields
     *
     * @deprecated deprecated since version 3.3.4
     *
     * @param string $fieldName The name of the repeater field to be retrieved. eg “gallery_images”
     * @param mixed  $postId    Specific post ID where your value was entered. Defaults to current post ID
     *
     * @return bool
     */
    public function theRepeaterField($fieldName, $postId = null)
    {
        return the_repeater_field($fieldName, $postId);
    }

    /**
     * Wraps the has_sub_field() function for Advanced Custom Fields
     *
     * @param string   $fieldName The name of the repeater field / flexible content field to loop through. eg “gallery_images”
     * @param int|null $postId    Specific post ID where your value was entered. Defaults to current post ID
     *
     * @return bool
     */
    public function hasSubField($fieldName, $postId = null)
    {
        return has_sub_field($fieldName, $postId);
    }

    /**
     * Wraps the have_rows() function for Advanced Custom Fields
     *
     * @param string $fieldName The name of the repeater / flexible content field to loop through. eg “gallery_images”
     * @param null|int $postId  Specific post ID where your value was entered. Defaults to current post ID
     *
     * @return bool
     */
    public function haveRows($fieldName, $postId = null)
    {
        return have_rows($fieldName, $postId);
    }

    /**
     * Wraps the acf_add_options_sub_page() function for Advanced Custom Fields
     *
     * @param string|array $page Either a string for the sub page title, or an array with more information
     *
     * @return bool
     */
    public function acfAddOptionsSubPage($page)
    {
        return acf_add_options_sub_page($page);
    }

    /**
     * Wraps the the_sub_field() function for Advanced Custom Fields
     *
     * @param string $subFieldName the name of the field to be displayed. eg “page_content”
     */
    public function theSubField($subFieldName)
    {
        the_sub_field($subFieldName);
    }

    /**
     * Wraps the acf_form() function for Advanced Custom Fields
     *
     * @param array $options An optional array containing 1 or more settings
     */
    public function acfForm($options = array())
    {
        acf_form($options);
    }

    /**
     * Wraps the get_field_objects() function for Advanced Custom Fields
     *
     * @param string $postId Specific post ID where your value was entered. Defaults to current post ID
     *
     * @return array|bool
     */
    public function getFieldObjects($postId)
    {
        return get_field_objects($postId);
    }

    /**
     * Wraps the get_row_layout() function for Advanced Custom Fields
     *
     * @return bool
     */
    public function getRowLayout()
    {
        return get_row_layout();
    }

    /**
     * Wraps the get_sub_field_object() function for Advanced Custom Fields
     *
     * @param string $fieldKey The key or name of the field to be retrieved
     *
     * @return bool
     */
    public function getSubFieldObject($fieldKey)
    {
        return get_sub_field_object($fieldKey);
    }

    /**
     * Wraps the the_flexible_field() function for Advanced Custom Fields
     *
     * @deprecated deprecated since version 3.3.4 please replace with hasSubField()
     *
     * @param string   $fieldName The name of the flexible content field to be retrieved
     * @param null|int $postId    Specific post ID where your value was entered. Defaults to current post ID
     */
    public function theFlexibleField($fieldName, $postId = null)
    {
        the_flexible_field($fieldName, $postId);
    }

    /**
     * Wraps the acf_set_options_page_menu() function for Advanced Custom Fields
     *
     * @param string $menuName The name for the parent Options Page menu item
     */
    public function acfSetOptionsPageMenu($menuName)
    {
        acf_set_options_page_menu($menuName);
    }

    /**
     * Wraps the acf_add_options_page() function for Advanced Custom Fields
     *
     * @param null|string|array $page A string for the page title, or an array of settings. If left blank, default settings will be used.
     */
    public function acfAddOptionsPage($page = null)
    {
        acf_add_options_page($page);
    }

    /**
     * Wraps the acf_set_options_page_title() function for Advanced Custom Fields
     *
     * @param string $title The name for the parent Options Page menu item
     */
    public function acfSetOptionsPageTitle($title)
    {
        acf_set_options_page_title($title);
    }

    /**
     * Wraps the acf_set_options_page_capability() function for Advanced Custom Fields
     * @param string $capability The name for the parent Options Page menu capability. Defaults to ‘edit_posts’
     */
    public function acfSetOptionsPageCapability($capability = 'edit_posts')
    {
        acf_set_options_page_capability($capability);
    }

    /**
     * Wraps the update_sub_field() function for Advanced Custom Fields
     *
     * @param string|array $selector The sub field name or key, or an array of ancestors and row numbers
     * @param mixed        $value    The new value to save in the database
     * @param null|int     $postId   The post ID of which the value is saved to
     *
     * @return mixed
     */
    public function updateSubField($selector, $value, $postId = null)
    {
        return update_sub_field($selector, $value, $postId);
    }




}