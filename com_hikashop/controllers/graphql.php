<?php
/**
 *              test from chromeiQL
 * endpoint = your_joomla_url/index.php?option=com_hikashop&ctrl=graphql&task=query
 * query =
 *          query{product(id:7){product_id,product_name}}
 *          query{products(category:2){product_id,product_name}}
 *
 *              test from url
 * index.php?option=com_hikashop&ctrl=graphql&task=query&query=query{products(category:2){product_id,product_name}}
 * index.php?option=com_hikashop&ctrl=graphql&task=query&query=query{product(id:7){product_id,product_name}}
*/


defined('_JEXEC') or die;
$loader = include JPATH_LIBRARIES . '/vendor/autoload.php';
$loader->setPsr4('JGraphQL\\', [JPATH_LIBRARIES . "/vendor/altylya-jgraphql/src/"]);

// modify line to your namespace
$loader->setPsr4('JGraphQL\\Hikashop\\', [JPATH_COMPONENT . "/graphql/"]);

use JGraphQL\Hikashop\ComHikashopTypes; // change with your namespace

/**
 * Class GraphqlController
 */
class GraphqlController extends JGraphQL\JgraphqlControllerBase {

	/**
	 * GraphqlController constructor.
	 *
	 * @param array $config
	 */
	public function  __construct(array $config = array())
	{
		$this->schema = new \GraphQL\Type\Schema([
			'query'    => ComHikashopTypes::query(), // change for your querytype file
			'mutation' => null,
		]);
		parent::__construct($config);
	}

}

