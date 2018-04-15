<?php
namespace Schmidtch\Survey\View;

class TemplateParser extends \TYPO3\CMS\Fluid\Core\Parser\TemplateParser {
	protected $namespacesBase = array();
	public function initializeObject() {
		$this->namespacesBase = $this->namespaces += array(
			'survey' => 'Schmidtch\Survey\ViewHelpers'
		);
	}
	protected function reset() {
		$this->namespaces = $this->namespacesBase;
	}
}

?>