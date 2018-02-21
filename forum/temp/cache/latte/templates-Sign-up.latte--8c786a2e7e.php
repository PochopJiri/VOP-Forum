<?php
// source: H:\Programy\xampp\htdocs\forum\app\presenters/templates/Sign/up.latte

use Latte\Runtime as LR;

class Template8c786a2e7e extends Latte\Runtime\Template
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
?>    Vytvořit účet
<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div class="card border-primary mx-auto" style="max-width: 25rem;">
    <div class="card-header bg-transparent text-center text-primary mr-4 ml-4"><h2>Vytvořit účet</h2></div>
    <div class="card-body text-primary ">
<?php
		$form = $_form = $this->global->formsStack[] = $this->global->uiControl["signUpForm"];
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
                <label for="InputForename"<?php
		$_input = end($this->global->formsStack)["forename"];
		echo $_input->getLabelPart()->addAttributes(array (
		'for' => NULL,
		))->attributes() ?>>Jméno:</label>
                <input type="text" class="form-control" id="InputForename" placeholder="Zadejte jméno"<?php
		$_input = end($this->global->formsStack)["forename"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		'id' => NULL,
		'placeholder' => NULL,
		))->attributes() ?>>
            </div>
            <div class="form-group">
                <label for="InputSurname"<?php
		$_input = end($this->global->formsStack)["surname"];
		echo $_input->getLabelPart()->addAttributes(array (
		'for' => NULL,
		))->attributes() ?>>Příjmení:</label>
                <input type="text" class="form-control" id="InputSurname" placeholder="Zadejte příjmení"<?php
		$_input = end($this->global->formsStack)["surname"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		'id' => NULL,
		'placeholder' => NULL,
		))->attributes() ?>>
            </div>
            <div class="form-group">
                <label for="InputEmail"<?php
		$_input = end($this->global->formsStack)["email"];
		echo $_input->getLabelPart()->addAttributes(array (
		'for' => NULL,
		))->attributes() ?>>E-mail:</label>
                <input type="email" class="form-control" id="InputEmail" placeholder="Zadejte e-mail"<?php
		$_input = end($this->global->formsStack)["email"];
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
            <div class="form-group">
                <label for="InputPicture"<?php
		$_input = end($this->global->formsStack)["picture"];
		echo $_input->getLabelPart()->addAttributes(array (
		'for' => NULL,
		))->attributes() ?>>Obrázek:</label>
                <input type="file" class="form-control" id="InputPicture" placeholder="Vyberte obrázek"<?php
		$_input = end($this->global->formsStack)["picture"];
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
		))->attributes() ?>>Registrovat se</button>
<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), false);
?>        </form>
        <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:in")) ?>">Máte již účet? - Přihlaste se</a>
    </div>
</div>
<?php
	}

}
