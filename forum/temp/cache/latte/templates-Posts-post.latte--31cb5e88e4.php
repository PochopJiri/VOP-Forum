<?php
// source: H:\Programy\xampp\htdocs\forum\app\presenters/templates/Posts/post.latte

use Latte\Runtime as LR;

class Template31cb5e88e4 extends Latte\Runtime\Template
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
		if (isset($this->params['comment'])) trigger_error('Variable $comment overwritten in foreach on line 39');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockTitle($_args)
	{
		extract($_args);
		?>    <?php echo LR\Filters::escapeHtmlText($post->title) /* line 2 */ ?>

<?php
	}


	function blockContent($_args)
	{
		extract($_args);
		?><h2 style="display: inline-block;"><?php echo LR\Filters::escapeHtmlText($post->title) /* line 5 */ ?></h2>
<?php
		if ($editRights) {
?>
    <div class="btn-group" style="float: right;" role="group">
        <a class="btn btn-sm btn-secondary" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Posts:edit", ['id' => $post->id])) ?>">Upravit</a>
        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletePost">Smazat</button>
    </div>
<div class="modal fade" id="deletePost" tabindex="-1" role="dialog" aria-labelledby="deletePost" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Smazat příspěvek</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Opravdu si přejete smazat tento příspěvek?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrušit</button>
                <a class="btn btn-danger" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Posts:deletePost", ['id' => $post->id])) ?>">Smazat</a>
            </div>
        </div>
    </div>
</div>
<?php
		}
?>
<br>
Autor: <a style="color: black" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Profile:show", ['id' => $author->id])) ?>"><?php
		echo LR\Filters::escapeHtmlText($author->username) /* line 32 */ ?></a><br>
Kategorie: <a style="color: black" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Posts:category", ['id' => $category->id])) ?>"><?php
		echo LR\Filters::escapeHtmlText($category->name) /* line 33 */ ?></a>
<div style="padding-bottom: 50px; margin-top: 10px; margin-bottom: 10px;">
<?php echo LR\Filters::escapeHtmlText($post->content) /* line 35 */ ?><br>
</div>
<h4>Komentáře</h4>
<hr>
<?php
		$iterations = 0;
		foreach ($comments as $comment) {
?>
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-1 col-2">
            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Profile:show", ['id' => $comment['author']->id])) ?>"><img class="rounded img-fluid" style="padding: 1px;" src="<?php
			echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 42 */ ?>/<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($comment['author']->picture)) /* line 42 */ ?>" alt="avatar"></a>
        </div>
        <div class="col-md-11 col-10" style="padding-left: 0;">
            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Profile:show", ['id' => $comment['author']->id])) ?>"><?php
			echo LR\Filters::escapeHtmlText($comment['author']->username) /* line 45 */ ?></a> - <?php
			echo LR\Filters::escapeHtmlText($comment['created']) /* line 45 */;
			echo LR\Filters::escapeHtmlText($comment['updated']) /* line 45 */ ?>

<?php
			if ($comment['editRights']) {
?>
                <a href="#">upravit</a> / <a href="#">smazat</a>
<?php
			}
?>
            <br>
            <?php echo LR\Filters::escapeHtmlText($comment['db']->content) /* line 50 */ ?>

        </div>
    </div>
<?php
			$iterations++;
		}
		if ($user->isLoggedIn()) {
			$form = $_form = $this->global->formsStack[] = $this->global->uiControl["addComment"];
			?>    <form<?php
			echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
			), false) ?>>
        <div class="form-group">
            <textarea type="text" class="form-control" id="InputUsername" placeholder="Přidejte komentář"<?php
			$_input = end($this->global->formsStack)["text"];
			echo $_input->getControlPart()->addAttributes(array (
			'type' => NULL,
			'class' => NULL,
			'id' => NULL,
			'placeholder' => NULL,
			))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary"<?php
			$_input = end($this->global->formsStack)["add"];
			echo $_input->getControlPart()->addAttributes(array (
			'type' => NULL,
			'class' => NULL,
			))->attributes() ?>>Přidat</button>
<?php
			echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), false);
?>    </form>
<?php
		}
		else {
			?>    Pokud chcete přidávat komentáře, tak se musíte <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:in", ['backlink' => $presenter->storeRequest()])) ?>">přihlásit</a>.
<?php
		}
?>

<?php
	}

}
