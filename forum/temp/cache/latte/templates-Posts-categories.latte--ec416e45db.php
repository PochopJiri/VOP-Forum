<?php
// source: H:\Programy\xampp\htdocs\forum\app\presenters/templates/Posts/categories.latte

use Latte\Runtime as LR;

class Templateec416e45db extends Latte\Runtime\Template
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
		if (isset($this->params['post'])) trigger_error('Variable $post overwritten in foreach on line 26');
		if (isset($this->params['category'])) trigger_error('Variable $category overwritten in foreach on line 5');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockTitle($_args)
	{
?>    Kategorie
<?php
	}


	function blockContent($_args)
	{
		extract($_args);
		$iterations = 0;
		foreach ($iterator = $this->global->its[] = new LR\CachingIterator($categories) as $category) {
			?>    <h4><a style="color: #343a40" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Posts:category", ['id' => $category['db']->id])) ?>">Kategorie: <?php
			echo LR\Filters::escapeHtmlText($category['db']->name) /* line 6 */ ?></a></h4>
<?php
			if ($category['postsCount'] == 0) {
?>
        <div class="row" style="min-height: 48px; margin-bottom: 48px; border-top: 1px solid rgba(0,0,0,0.15); margin-left: 2px; margin-right: 2px;">
            <div class="col-12" style="padding-left: 2px;">
                V této kategorii nejsou žádné příspěvky.
            </div>
        </div>
<?php
			}
			else {
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
			}
			$iterations = 0;
			foreach ($iterator = $this->global->its[] = new LR\CachingIterator($category['posts']) as $post) {
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
            <a style="color: black" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Profile:show", ['id' => $post['db']->author_id])) ?>"><?php
				echo LR\Filters::escapeHtmlText($post['db']->author) /* line 33 */ ?></a>
        </div>
        <div class="col-6" style="padding: 0;">
            <a style="color: black" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Posts:post", ['id' => $post['db']->id])) ?>"><?php
				echo LR\Filters::escapeHtmlText($post['db']->title) /* line 36 */ ?></a>
        </div>
        <div class="col-3" style="text-align: right; padding-right: 3px;">
            <?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $post['db']->updated, 'j. n. Y')) /* line 39 */ ?>

        </div>
        </div>
<?php
				if ($iterator->last) {
?>
            <div class="row" style="text-align: center; min-height: 48px; border-top: 1px solid rgba(0,0,0,.15); margin-left: 2px; margin-right: 2px;">
                <div class="col-12" style="line-height: 48px; margin-bottom: 45px;">
<?php
					if ($category['postsCount'] > 5) {
						?>                        <b><a style="color: #343a40" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Posts:category", ['id' => $category['db']->id])) ?>">a další ...</a></b>
<?php
					}
?>
                </div>
            </div>
<?php
				}
				$iterations++;
			}
			array_pop($this->global->its);
			$iterator = end($this->global->its);
			$iterations++;
		}
		array_pop($this->global->its);
		$iterator = end($this->global->its);
		
	}

}
