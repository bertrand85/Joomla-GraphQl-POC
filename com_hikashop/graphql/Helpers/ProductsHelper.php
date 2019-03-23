<?php
namespace JGraphQL\Hikashop\Helpers;


class ProductsHelper
{
	/**
	 * @param $category_id
	 *
	 * @return mixed
	 */
	static function getCategoryProducts($category_id) {

		$db			= \JFactory::getDBO();
		$app = \JFactory::getApplication();
		$params = $app->getParams();
		$config =& hikashop_config();

		$query = 'SELECT * FROM '.hikashop_table('product').' WHERE product_access=\'all\' AND product_published=1 AND product_type=\'main\' ';
		if(!$config->get('show_out_of_stock',1)){
			$query.=' AND product_quantity!=0 ';
		}
		$query .= ' ORDER BY '.$config->get('hikarss_order','product_id').' DESC';
		$query .= ' LIMIT '.$config->get('hikarss_element','10');
		$db->setQuery($query);
		$products = $db->loadObjectList();

		return $products;

	}

	/**
	 * @param $id
	 */
	static function getProduct( $id ) {
		$db			= \JFactory::getDBO();
		$app = \JFactory::getApplication();
		$params = $app->getParams();
		$config =& hikashop_config();

		$query = 'SELECT * FROM '.hikashop_table('product').' WHERE product_access=\'all\' AND product_published=1 AND product_type=\'main\' AND product_id=' . $id;
		if(!$config->get('show_out_of_stock',1)){
			$query.=' AND product_quantity!=0 ';
		}
		$query .= ' ORDER BY '.$config->get('hikarss_order','product_id').' DESC';
		$query .= ' LIMIT '.$config->get('hikarss_element','10');
		$db->setQuery($query);
		$product = $db->loadObject();

		return $product;
	}
}