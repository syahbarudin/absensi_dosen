<?php if ($pager) : ?>
    <ul class="pagination">
        <?php if ($pager->hasPrevious('group1', 'default_full')) : ?>
            <li><a href="<?= $pager->getFirst('group1', 'default_full') ?>" aria-label="<?= lang('Pager.first') ?>" class="pagination-link">First</a></li>
            <li><a href="<?= $pager->getPrevious('group1', 'default_full') ?>" aria-label="<?= lang('Pager.previous') ?>" class="pagination-link">Previous</a></li>
        <?php endif ?>

        <?php foreach ($pager->links('group1', 'default_full') as $link) : ?>
            <li <?= $link['active'] ? 'class="active"' : '' ?>>
                <a href="<?= $link['uri'] ?>" class="pagination-link"><?= $link['title'] ?></a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext('group1', 'default_full')) : ?>
            <li><a href="<?= $pager->getNext('group1', 'default_full') ?>" aria-label="<?= lang('Pager.next') ?>" class="pagination-link">Next</a></li>
            <li><a href="<?= $pager->getLast('group1', 'default_full') ?>" aria-label="<?= lang('Pager.last') ?>" class="pagination-link">Last</a></li>
        <?php endif ?>
    </ul>
<?php endif ?>
