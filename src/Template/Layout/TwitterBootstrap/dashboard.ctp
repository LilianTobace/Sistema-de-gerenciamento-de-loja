<?php
/* @var $this \Cake\View\View */
use Cake\Core\Configure;
$this->Html->css('BootstrapUI.dashboard', ['block' => true]);
$this->prepend('tb_body_attrs', ' class="' . implode(' ', [$this->request->getParam('controller'), $this->request->getParam('action')]) . '" ');
$this->start('tb_body_start');
?>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual2.css>

<header style="position: fixed;"> 
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background: #0080FF; position: fixed; ">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><?= Configure::read('App.title') ?></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right visible-xs">
                    <?= $this->fetch('tb_actions') ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a data-toggle="modal" data-target=".bd-example-modal-xl"><img src="/projeto/img/help.png" title="Manual" id="Manual" alt="" class="manual" style="margin-left: -120%;"></a></li>
                    <li><p style="margin-top: 19%; white-space: nowrap; margin-left: -20%; color:black; font-weight: bold;"><?php echo $_SESSION['nomeUsuario'] ?></p></li>
                    <li class="nav-divider"></li>
                    <li><a href="/projeto/pagprincipal">Página Principal</a></li>
                    <li><a href="/projeto/users/login">Logout</a></li>
                </ul>
                <!--<form class="navbar-form navbar-right">
                    <input type="text" class="form-control" placeholder="Search...">
                </form>
                -->
            </div>
        </div>
    </div>   
</header>
<aside style="position: fixed;"> 
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <?= $this->fetch('tb_sidebar') ?>
        </div>
</aside>


<?php
/**
 * Default `flash` block.
 */
if (!$this->fetch('tb_flash')) {
    $this->start('tb_flash');
    if (isset($this->Flash)) {
        echo $this->Flash->render();
    }
    $this->end();
}
$this->end();

$this->start('tb_body_end');
echo '</body>';
$this->end();

$this->append('content', '</div></div></div>');
echo $this->fetch('content'); ?>
