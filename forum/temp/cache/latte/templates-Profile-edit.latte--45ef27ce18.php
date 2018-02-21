<?php
// source: H:\Programy\xampp\htdocs\forum\app\presenters/templates/Profile/edit.latte

use Latte\Runtime as LR;

class Template45ef27ce18 extends Latte\Runtime\Template
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
?>    Upravit profil
<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div class="card mt-5 mx-auto" style="max-width: 30rem;">
    <div class="card-body">
        <img src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 7 */ ?>/<?php
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($shownUser->picture)) /* line 7 */ ?>" class="rounded mx-auto d-block mb-3" style="max-height: 15em; max-width: 15em;">
<?php
		$form = $_form = $this->global->formsStack[] = $this->global->uiControl["editUserForm"];
		?>        <form<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
		), false) ?>>
            <dl class="row">
                <dt class="col-lg-5">Uživatelské jméno:</dt>
                <dd class="col-sm-7">
                    <div class="form-group">
                        <input type="text" class="form-control" id="InputUsername" value="<?php echo LR\Filters::escapeHtmlAttr($shownUser->username) /* line 13 */ ?>"<?php
		$_input = end($this->global->formsStack)["username"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		'id' => NULL,
		'value' => NULL,
		))->attributes() ?>>
                    </div>
                </dd>
                <dt class="col-sm-5">Jméno:</dt>
                <dd class="col-sm-7">
                    <div class="form-group">
                        <input type="text" class="form-control" id="InputForename" value="<?php echo LR\Filters::escapeHtmlAttr($shownUser->forename) /* line 19 */ ?>"<?php
		$_input = end($this->global->formsStack)["forename"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		'id' => NULL,
		'value' => NULL,
		))->attributes() ?>>
                    </div>
                </dd>
                <dt class="col-sm-5">Příjmení:</dt>
                <dd class="col-sm-7">
                    <div class="form-group">
                        <input type="text" class="form-control" id="InputSurname" value="<?php echo LR\Filters::escapeHtmlAttr($shownUser->surname) /* line 25 */ ?>"<?php
		$_input = end($this->global->formsStack)["surname"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		'id' => NULL,
		'value' => NULL,
		))->attributes() ?>>
                    </div>
                </dd>
                <dt class="col-sm-5">E-mail:</dt>
                <dd class="col-sm-7">
                    <div class="form-group">
                        <input type="text" class="form-control" id="InputEmail" value="<?php echo LR\Filters::escapeHtmlAttr($shownUser->email) /* line 31 */ ?>"<?php
		$_input = end($this->global->formsStack)["email"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		'id' => NULL,
		'value' => NULL,
		))->attributes() ?>>
                    </div>
                </dd>
<?php
		if ($user->isInRole('admin')) {
?>
                    <dt class="col-sm-5">Role:</dt>
                    <dd class="col-sm-7 text-right">
                        <div class="form-group">
                            <select class="form-control" id="InputRole"<?php
			$_input = end($this->global->formsStack)["role"];
			echo $_input->getControlPart()->addAttributes(array (
			'class' => NULL,
			'id' => NULL,
			))->attributes() ?>>
<?php echo $_input->getControl()->getHtml() ?>                            </select>
                        </div>
                    </dd>
<?php
		}
?>
            </dl>
            <div class="btn-group" style="float: right;" role="group">
                <a class="btn btn-secondary" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Profile:show", ['id' => $shownUser->id])) ?>">Zpět</a>
                <button type="submit" class="btn btn-success">Uložit</button>
            </div>
<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), false);
?>        </form>
    </div>
</div><?php
	}

}
