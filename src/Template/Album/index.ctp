<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Album'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="album index large-9 medium-8 columns content">
    <h3><?= __('Album') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('path') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($album as $album): ?>
            <tr>
                <td><?= $this->Number->format($album->id) ?></td>
                <td><?= h($album->created) ?></td>
                <td><?= h($album->name) ?></td>
                <td><?= h($album->path) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $album->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $album->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $album->id], ['confirm' => __('Are you sure you want to delete # {0}?', $album->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
