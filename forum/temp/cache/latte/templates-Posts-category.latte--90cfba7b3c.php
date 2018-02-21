<?php
// source: H:\Programy\xampp\htdocs\forum\app\presenters/templates/Posts/category.latte

use Latte\Runtime as LR;

class Template90cfba7b3c extends Latte\Runtime\Template
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
		if (isset($this->params['post'])) trigger_error('Variable $post overwritten in foreach on line 39');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockTitle($_args)
	{
		extract($_args);
		?>    <?php echo LR\Filters::escapeHtmlText($category->name) /* line 2 */ ?>

<?php
	}


	function blockContent($_args)
	{
		extract($_args);
		?><h4 style="display: inline-block;"><?php echo LR\Filters::escapeHtmlText($category->name) /* line 5 */ ?></h4>
<?php
		if ($editRights) {
?>
<button type="button" class="btn btn-sm btn-danger" style="float: right;" data-toggle="modal" data-target="#confirmModal">Smazat</button>
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Smazat kategorii</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Opravdu si přejete smazat tuto kategorii a všechny příspěvky v ní obsažené?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrušit</button>
                <a class="btn btn-danger" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Posts:deleteCategory", ['id' => $category->id])) ?>">Smazat</a>
            </div>
        </div>
    </div>
</div>
<?php
		}
?>
<div class="row" style="align-items: center; min-height: 48px; border-top: 1px solid rgba(0,0,0,.15); margin-left: 2px; margin-right: 2px;">
    <div class="col-3" style="padding-left: 3px;">
        <b>Autor</b>
    </div>
    <div class="col-6" style="padding: 0;">
        <b>Název příspěvku</b>
    </div>
    <div class="col-3" style="text-align: right; padding-right: 3px;">
        <b>Poslední změna</b>
    </div>
</div>
<?php
		$iterations = 0;
		foreach ($iterator = $this->global->its[] = new LR\CachingIterator($posts) as $post) {
			if ($iterator->odd) {
?>
        <div class="row" style="background: rgba(0,0,0,.05); align-items: center; min-height: 48px; word-wrap: break-word;  border-top: 1px solid rgba(0,0,0,.15); margin-left: 2px; margin-right: 2px;">
<?php
			}
			else {
?>
        <div class="row" style="align-items: center; min-height: 48px; word-wrap: break-word;  border-top: 1px solid rgba(0,0,0,.15); margin-left: 2px; margin-right: 2px;">
<?php
			}
?>
    <div class="col-3" style="padding-left: 3px;">
        <a style="color: black" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Profile:show", ['id' => $post->author_id])) ?>"><?php
			echo LR\Filters::escapeHtmlText($post->author) /* line 46 */ ?></a>
    </div>
    <div class="col-6" style="padding: 0;">
        <a style="color: black" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Posts:post", ['id' => $post->id])) ?>"><?php
			echo LR\Filters::escapeHtmlText($post->title) /* line 49 */ ?></a>
    </div>
    <div class="col-3" style="text-align: right; padding-right: 3px;">
        <?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $post->updated, 'j. n. Y')) /* line 52 */ ?>

    </div>
    </div>
<?php
			$iterations++;
		}
		array_pop($this->global->its);
		$iterator = end($this->global->its);
		
	}

}
