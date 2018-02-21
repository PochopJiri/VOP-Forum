<?php
// source: H:\Programy\xampp\htdocs\forum\app\presenters/templates/Homepage/error.latte

use Latte\Runtime as LR;

class Templateb7e2cfea62 extends Latte\Runtime\Template
{
	public $blocks = [
		'title' => 'blockTitle',
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'title' => 'html',
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('title', get_defined_vars());
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockTitle($_args)
	{
?>    Chyba
<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div style="text-align: center;">
    <a class="btn btn-secondary" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:")) ?>">Návrat domů</a>
</div><?php
	}

}
