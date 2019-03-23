<?php
/**
* @package     Joomla.Site
* @subpackage  com_content
*
* @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * query {article(id:2){title,alias,introtext,params}}
 * query {articles(category:2){title,alias,introtext,params}}
*/

//use function \Digia\GraphQL\buildSchema as buildSchematoto;

defined('_JEXEC') or die;
$loader = include JPATH_LIBRARIES . '/vendor/autoload.php';
$loader->setPsr4('JGraphQL\\', [JPATH_LIBRARIES . "/vendor/altylya-jgraphql/src/"]);
$loader->setPsr4('JGraphQL\\Content\\', [JPATH_COMPONENT . "/graphql/"]);

use JGraphQL\Content\ComContentTypes;
JLoader::import('joomla.application.component.model');

/**
* Content article class.
*
* @since  1.6.0
*/
class ContentControllerGraphql extends JGraphQL\JgraphqlControllerBase {

	public function  __construct(array $config = array())
	{
		$this->schema = new \GraphQL\Type\Schema([
			'query'    => ComContentTypes::query(),
			'mutation' => null,
		]);
		parent::__construct($config);
	}

/*	public function query() {

		try
		{


			$mutationType = new ObjectType([
				'name'   => 'Calc',
				'fields' => [
					'sum' => [
						'type'    => Type::int(),
						'args'    => [
							'x' => ['type' => Type::int()],
							'y' => ['type' => Type::int()],
						],
						'resolve' => function ($root, $args) {
							return $args['x'] + $args['y'];
						},
					],
				],
			]);

			// See docs on schema options:
			// http://webonyx.github.io/graphql-php/type-system/schema/#configuration-options
			$schema = new Schema([
				'query'    => ComContentTypes::query(),
				'mutation' => $mutationType,
			]);
			$input = $this->input->get('query',null,'raw');

			if( is_null($input) ) {
				$rawInput = file_get_contents('php://input');
				$decodeInput = json_decode($rawInput, true);
				$input = $decodeInput['query'];
			}

			$query = $input;
			$variableValues = isset($input['variables']) ? $input['variables'] : null;

			$rootValue = ['controller' => $this, 'app' => JFactory::getApplication()];
			$result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
			$output = $result->toArray();
		} catch (\Exception $e) {
			$output = [
				'error' => [
					'message' => $e->getMessage()
				]
			];
		}
		header('Content-Type: application/json; charset=UTF-8');
		echo json_encode($output);
		exit();
	}
*/
}

