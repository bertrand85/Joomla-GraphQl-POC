<?php
namespace JGraphQL;

defined('_JEXEC') or die;
$loader = include JPATH_LIBRARIES . '/vendor/autoload.php';
$loader->setPsr4('GraphQL\\', [JPATH_LIBRARIES . "/vendor/graphql-php-master/src/"]);

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\GraphQL;
use Joomla\CMS\MVC\Controller\BaseController;


class JgraphqlControllerBase extends BaseController {

	protected $schema;

	public function  __construct(array $config = array())
	{

		parent::__construct($config);
	}

	public function query() {

		try
		{

			// See docs on schema options:
			// http://webonyx.github.io/graphql-php/type-system/schema/#configuration-options
			$input = $this->input->get('query',null,'raw');

			if( is_null($input) ) {
				$rawInput = file_get_contents('php://input');
				$decodeInput = json_decode($rawInput, true);
				$input = $decodeInput['query'];
			}

			$query = $input;
			$variableValues = isset($input['variables']) ? $input['variables'] : null;

			$rootValue = ['controller' => $this, 'app' => \JFactory::getApplication()];
			$result = GraphQL::executeQuery($this->schema, $query, $rootValue, null, $variableValues);
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

}

