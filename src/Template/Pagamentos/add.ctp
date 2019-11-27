<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pagamento $pagamento
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Pagamentos'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="pagamentos form large-9 medium-8 columns content">
    <?= $this->Form->create($pagamento) ?>
    <fieldset>
        <legend><?= __('Add Pagamento') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
