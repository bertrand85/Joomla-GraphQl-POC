<?php
/**
 *              test from chromeiQL
 * endpoint = your_joomla_url/index.php?component=com_content&task=graphql.query
 * query =
 *          query {article(id:2){title,alias,introtext,params}}
 *          query {articles(category:2){title,alias,introtext,params}}
 *
 *              test from url
 * your_joomla_url/index.php?component=com_content&task=graphql.query&query=query%20{article(id:2){id,title}}
 * your_joomla_url/index.php?component=com_content&task=graphql.query&query=query%20{articles(category:2){id,title}}
*/

defined('_JEXEC') or die;
$loader = include JPATH_LIBRARIES . '/vendor/autoload.php';
$loader->setPsr4('JGraphQL\\', [JPATH_LIBRARIES . "/vendor/altylya-jgraphql/src/"]);

// modify line to your namespace
$loader->setPsr4('JGraphQL\\Content\\', [JPATH_COMPONENT . "/graphql/"]);

use JGraphQL\Content\ComContentTypes;  // change with your namespace

/**
 * Class ContentControllerGraphql
 */
class ContentControllerGraphql extends JGraphQL\JgraphqlControllerBase {

	/**
	 * ContentControllerGraphql constructor.
	 *
	 * @param array $config
	 */
	public function  __construct(array $config = array())
	{
		$this->schema = new \GraphQL\Type\Schema([
			'query'    => ComContentTypes::query(), // change for your querytype file
			'mutation' => null,
		]);
		parent::__construct($config);
	}

}

