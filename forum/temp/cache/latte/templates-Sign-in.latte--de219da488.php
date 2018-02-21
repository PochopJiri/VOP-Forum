<?php
// source: H:\Programy\xampp\htdocs\forum\app\presenters/templates/Sign/in.latte

use Latte\Runtime as LR;

class Templatede219da488 extends Latte\Runtime\Template
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
?>    Přihlásit se
<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div class="card border-primary mx-auto" style="max-width: 25rem;">
    <div class="card-header bg-transparent text-center text-primary mr-4 ml-4"><h2>Přihlásit se</h2></div>
    <div class="card-body text-primary ">
<?php
		$form = $_form = $this->global->formsStack[] = $this->global->uiControl["signInForm"];
		?>        <form<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
		), false) ?>>
            <div class="form-group">
                <label for="InputUsername"<?php
		$_input = end($this->global->formsStack)["username"];
		echo $_input->getLabelPart()->addAttributes(array (
		'for' => NULL,
		))->attributes() ?>>Uživatelské jméno:</label>
                <input type="text" class="form-control" id="InputUsername" placeholder="Zadejte uživatelské jméno"<?php
		$_input = end($this->global->formsStack)["username"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		'id' => NULL,
		'placeholder' => NULL,
		))->attributes() ?>>
            </div>
            <div class="form-group">
                <label for="InputPassword"<?php
		$_input = end($this->global->formsStack)["password"];
		echo $_input->getLabelPart()->addAttributes(array (
		'for' => NULL,
		))->attributes() ?>>Heslo:</label>
                <input type="password" class="form-control" id="InputPassword" placeholder="Zadejte heslo"<?php
		$_input = end($this->global->formsStack)["password"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		'id' => NULL,
		'placeholder' => NULL,
		))->attributes() ?>>
            </div>
            <button type="submit" class="btn btn-primary mb-3"<?php
		$_input = end($this->global->formsStack)["add"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		))->attributes() ?>>Přihlásit se</button>
<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), false);
?>        </form>
        <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:up")) ?>">Jestě nemáte účet? - Zaregistrujte se</a>
    </div>
</div><?php
	}

}
