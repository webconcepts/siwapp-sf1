<?php
sfContext::getInstance()->getConfiguration()->loadHelpers(array('Date', 'Text', 'Number'));

class Common_Twig_Extension extends Twig_Extension
{
  public function getFilters()
  {
    return array(
      // DateHelper
      'date'        => new Twig_Filter_Function('format_date'),
      'datetime'    => new Twig_Filter_Function('format_datetime'),
      // TextHelper
      'format'      => new Twig_Filter_Function('simple_format_text', array('pre_escape' => 'html', 'is_safe' => array('html'))),
      'unlink'      => new Twig_Filter_Function('strip_links_text'),
      'nl2br'       => new Twig_Filter_Function('nl2br', array('pre_escape' => 'html', 'is_safe' => array('html'))),
      // NumberHelper
      'currency'    => new Twig_Filter_Function('common_twig_extension_format_currency'),
      'round'       => new Twig_Filter_Function('common_twig_extension_round'),
      'number'      => new Twig_Filter_Function('format_number'),
      // Other
      'count'       => new Twig_Filter_Function('count'),
      'unhttp'      => new Twig_Filter_Function('common_twig_extension_unhttp'),
      'product_reference' => new Twig_Filter_Function('product_reference'),
      'firstword'   => new Twig_Filter_Function('common_twig_extension_first_word'),
      'zeropad'     => new Twig_Filter_Function('common_twig_extension_zeropad'),
  	  // Custom
  	  'globalurl'   => new Twig_Filter_Function('common_twig_extension_globalurl'),
    );
  }
  
  public function getName()
  {
    return 'common';
  }
}

function common_twig_extension_globalurl($url)
{
  return "http://" . $_SERVER['HTTP_HOST'] .$url;
}

function common_twig_extension_format_currency($amount, $culture = null)
{
  $currency = sfContext::getInstance()->getUser()->getCurrency();
  return format_currency($amount, $currency, $culture);
}

function common_twig_extension_round($amount, $decimals = 2)
{
  return round($amount, $decimals);
}

function common_twig_extension_unhttp($url)
{
  return str_replace(array('http://', 'https://'), null, $url);
}

function product_reference($product_id){
    return Doctrine::getTable("Product")->getReference($product_id);
}

function common_twig_extension_first_word($string) 
{
  $array = explode(' ', $string);
  return $array[0];
}

function common_twig_extension_zeropad($string, $length = 3)
{
  return sprintf('%0'.$length.'d', $string);
}
