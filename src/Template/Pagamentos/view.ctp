<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pagamento $pagamento
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Pagamento'), ['action' => 'edit', $pagamento->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Pagamento'), ['action' => 'delete', $pagamento->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pagamento->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Pagamentos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pagamento'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pagamentos view large-9 medium-8 columns content">
    <h3><?= h($pagamento->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($pagamento->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($pagamento->id) ?></td>
        </tr>
    </table>
</div>
