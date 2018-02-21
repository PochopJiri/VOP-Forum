<?php
// source: H:\Programy\xampp\htdocs\forum\app\presenters/templates/Profile/show.latte

use Latte\Runtime as LR;

class Template077a91ce68 extends Latte\Runtime\Template
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
		extract($_args);
		?>    <?php echo LR\Filters::escapeHtmlText($shownUser->username) /* line 2 */ ?>

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
        <dl class="row">
            <dt class="col-lg-5">Uživatelské jméno:</dt>
            <dd class="col-lg-7 text-right"><?php echo LR\Filters::escapeHtmlText($shownUser->username) /* line 10 */ ?></dd>

            <dt class="col-sm-5">Jméno:</dt>
            <dd class="col-sm-7 text-right"><?php echo LR\Filters::escapeHtmlText($shownUser->forename) /* line 13 */ ?></dd>

            <dt class="col-sm-5">Příjmení:</dt>
            <dd class="col-sm-7 text-right"><?php echo LR\Filters::escapeHtmlText($shownUser->surname) /* line 16 */ ?></dd>

            <dt class="col-sm-5">E-mail:</dt>
            <dd class="col-sm-7 text-right"><?php echo LR\Filters::escapeHtmlText($shownUser->email) /* line 19 */ ?></dd>

            <dt class="col-sm-5">Role:</dt>
            <dd class="col-sm-7 text-right"><?php echo LR\Filters::escapeHtmlText($shownUser->role) /* line 22 */ ?></dd>
        </dl>
        <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Posts:my", ['id' => $shownUser->id])) ?>">Moje příspěvky</a>
<?php
		if ($user->isInRole('admin') || $shownUser->id == $user->id) {
			?>            <a class="btn btn-outline-secondary btn-sm float-right" role="button" aria-pressed="true" href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Profile:edit", ['id' => $shownUser->id, 'backlink' => $presenter->storeRequest()])) ?>">Upravit</a>
<?php
		}
?>
    </div>
</div><?php
	}

}
