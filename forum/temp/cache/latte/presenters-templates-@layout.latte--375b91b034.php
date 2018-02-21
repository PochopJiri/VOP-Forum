<?php
// source: H:\Programy\xampp\htdocs\forum\app\presenters/templates/@layout.latte

use Latte\Runtime as LR;

class Template375b91b034 extends Latte\Runtime\Template
{
	public $blocks = [
		'head' => 'blockHead',
		'scripts' => 'blockScripts',
	];

	public $blockTypes = [
		'head' => 'html',
		'scripts' => 'html',
	];


	function main()
	{
		extract($this->params);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>Fórum<?php
		if (isset($this->blockQueue["title"])) {
			?> - <?php
			$this->renderBlock('title', $this->params, function ($s, $type) {
				$_fi = new LR\FilterInfo($type);
				return LR\Filters::convertTo($_fi, 'html', $this->filters->filterContent('striphtml', $_fi, $s));
			});
		}
?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 13 */ ?>/css/style.css">
    <link rel="shortcut icon" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 14 */ ?>/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 15 */ ?>/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 16 */ ?>/css/custom.css">
	<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('head', get_defined_vars());
?>
</head>

<body>
        <nav id="nav" class="navbar nav fixed-top navbar-expand-lg navbar-dark bg-dark">
            <a id="navbar-brand" class="navbar-brand" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:")) ?>">
                <img id="navbar-brand-pic" src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 23 */ ?>/F.png" class="navbar-brand-pic" alt="">
                Forum
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span id="navbar-toggler-icon" class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?php
		if ($currentURL == "/forum/www/") {
			?>active<?php
		}
?>">
                        <a class="nav-link" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:")) ?>">Domů<?php
		if ($currentURL == "/forum/www/") {
			?><span class="sr-only">(current)</span><?php
		}
?></a>
                    </li>
                    <li class="nav-item <?php
		if ($currentURL == "/forum/www/posts/categories") {
			?>active<?php
		}
?>">
                        <a class="nav-link" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Posts:categories")) ?>">Příspěvky<?php
		if ($currentURL == "/forum/www/posts/categories") {
			?><span class="sr-only">(current)</span><?php
		}
?></a>
                    </li>
                    <li class="nav-item <?php
		if ($currentURL == "/forum/www/posts/add") {
			?>active<?php
		}
?>">
                        <a class="nav-link" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Posts:add")) ?>">Přidat příspěvek<?php
		if ($currentURL == "/forum/www/posts/add") {
			?><span class="sr-only">(current)</span><?php
		}
?></a>
                    </li>
                </ul>
<?php
		if ($user->isLoggedIn()) {
?>
                    <span>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown user-dropdown">
                            <a id="user-dropdown" class="col-sm nav-link dropdown user-dropdown" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                přihlášený uživatel: <?php echo LR\Filters::escapeHtmlText($User->username) /* line 46 */ ?>

                                <img id="profile-pic" src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 47 */ ?>/<?php
			echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($User->picture)) /* line 47 */ ?>" class="d-inline-block align-top profile-pic">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Profile:show", ['id' => $User->id])) ?>">Zobrazit profil</a>
                                <a class="dropdown-item" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Posts:my", ['id' => $User->id])) ?>">Moje příspvěvky</a>
                                <a class="dropdown-item" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:out")) ?>">Odhlásit se</a>
                            </div>
                        </li>
                    </ul>
                </span>
<?php
		}
		else {
			?>                    <a id="btn-signUp" class="btn btn-outline-secondary mr-2" role="button" aria-pressed="true" href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:up")) ?>">Vytvořit účet</a>
                    <a id="btn-signIn" class="btn btn-outline-primary mr-2" role="button" aria-pressed="true" href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:in")) ?>">Přihlásit se</a>
<?php
		}
?>
            </div>
        </nav>

        <div class="container content">
<?php
		$iterations = 0;
		foreach ($flashes as $flash) {
			if ($flash->type == 'success') {
?>
                    <div class="alert alert-success" role="alert">
                        <?php echo LR\Filters::escapeHtmlText($flash->message) /* line 68 */ ?>

                    </div>
<?php
			}
			elseif ($flash->type == 'danger') {
?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo LR\Filters::escapeHtmlText($flash->message) /* line 72 */ ?>

                    </div>
<?php
			}
			elseif ($flash->type == 'warning') {
?>
                    <div class="alert alert-warning" role="alert">
                        <?php echo LR\Filters::escapeHtmlText($flash->message) /* line 76 */ ?>

                    </div>
<?php
			}
			else {
?>
                    <div class="alert alert-secondary" role="alert">
                        <?php echo LR\Filters::escapeHtmlText($flash->message) /* line 80 */ ?>

                    </div>
<?php
			}
			$iterations++;
		}
		$this->renderBlock('content', $this->params, 'html');
?>
        </div>

<?php
		$this->renderBlock('scripts', get_defined_vars());
?>

        <footer class="footer">
            <div class="container">
                <div class="row text-center">
                    <div class="col-sm-12">
                        <h2>Learn almost anything  </h2>
                    </div>
                    <div class="col-sm-12">
                        © 2018 Jiří Pochop
                    </div>
                </div>
            </div>
        </footer>
</body>
</html>
<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['flash'])) trigger_error('Variable $flash overwritten in foreach on line 65');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockHead($_args)
	{
		
	}


	function blockScripts($_args)
	{
		extract($_args);
		?>            <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 88 */ ?>/bootstrap/js/jquery-3.2.1.slim.min.js"></script>
            <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 89 */ ?>/bootstrap/js/popper.js"></script>
            <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 90 */ ?>/bootstrap/js/bootstrap.min.js"></script>
            <script src="https://nette.github.io/resources/js/netteForms.min.js"></script>
            <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 92 */ ?>/js/main.js"></script>
            <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 93 */ ?>/js/custom.js"></script>
<?php
	}

}
