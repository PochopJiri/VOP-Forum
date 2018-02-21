<?php
// source: H:\Programy\xampp\htdocs\forum\app\presenters/templates/Posts/add.latte

use Latte\Runtime as LR;

class Template5243cd2a97 extends Latte\Runtime\Template
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
?>    Přidat příspěvek
<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<h2>Přidat příspěvek</h2><br>
<div class="card mx-auto">
    <div class="card-body">
<?php
		$form = $_form = $this->global->formsStack[] = $this->global->uiControl["addPost"];
		?>        <form<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
		), false) ?>>
            <div class="form-group col-sm-5">
                <label for="SelectCategory"<?php
		$_input = end($this->global->formsStack)["category"];
		echo $_input->getLabelPart()->addAttributes(array (
		'for' => NULL,
		))->attributes() ?>>Kategorie:</label>
                <select class="form-control" id="SelectCategory"<?php
		$_input = end($this->global->formsStack)["category"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'id' => NULL,
		))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></select>
                <div style="color: #868e96;">Nevyhovuje Vám žádná z kategorií? <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Posts:createCategory")) ?>">Založte novou</a>!</div>
            </div>
            <div class="form-group col-sm-12">
                <label for="InputTitle"<?php
		$_input = end($this->global->formsStack)["title"];
		echo $_input->getLabelPart()->addAttributes(array (
		'for' => NULL,
		))->attributes() ?>>Titulek:</label>
                <input type="text" class="form-control" id="InputTitle" placeholder="Zadejte titulek"<?php
		$_input = end($this->global->formsStack)["title"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		'id' => NULL,
		'placeholder' => NULL,
		))->attributes() ?>>
            </div>
            <div class="form-group col-sm-12">
                <label for="InputContent"<?php
		$_input = end($this->global->formsStack)["content"];
		echo $_input->getLabelPart()->addAttributes(array (
		'for' => NULL,
		))->attributes() ?>>Obsah:</label>
                <textarea type="text" style="min-height: 250px;" class="form-control" id="InputContent" placeholder="Zadejte obsah"<?php
		$_input = end($this->global->formsStack)["content"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'style' => NULL,
		'class' => NULL,
		'id' => NULL,
		'placeholder' => NULL,
		))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></textarea>
            </div>
            <button type="submit" style="float: right;" class="btn btn-primary mb-3 mr-3"<?php
		$_input = end($this->global->formsStack)["add"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'style' => NULL,
		'class' => NULL,
		))->attributes() ?>>Přidat příspěvek</button>
<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), false);
?>        </form>
    </div>
</div><?php
	}

}
