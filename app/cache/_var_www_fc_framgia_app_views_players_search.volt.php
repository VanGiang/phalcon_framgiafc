
<?php echo $this->getContent(); ?>

<table width="100%">
    <tr>
        <td align="left">
            <?php echo $this->tag->linkTo(array('players/index', 'Go Back')); ?>
        </td>
        <td align="right">
            <?php echo $this->tag->linkTo(array('players/new', 'Create ')); ?>
        </td>
    <tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Team</th>
            <th>Position</th>
            <th>Point</th>
            <th>Attack Of Point</th>
            <th>Defense Of Point</th>
         </tr>
    </thead>
    <tbody>
    <?php if (isset($page->items)) { ?>
    <?php foreach ($page->items as $player) { ?>
        <tr>
            <td><?php echo $player->id; ?></td>
            <td><?php echo $player->name; ?></td>
            <td><?php echo $player->team; ?></td>
            <td><?php echo $player->position; ?></td>
            <td><?php echo $player->point; ?></td>
            <td><?php echo $player->attack_point; ?></td>
            <td><?php echo $player->defense_point; ?></td>
            <td><?php echo $this->tag->linkTo(array('players/edit/' . $player->id, 'Edit')); ?></td>
            <td><?php echo $this->tag->linkTo(array('players/delete/' . $player->id, 'Delete')); ?></td>
        </tr>
    <?php } ?>
    <?php } ?>
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td><?php echo $this->tag->linkTo(array('players/search', 'First')); ?></td>
                        <td><?php echo $this->tag->linkTo(array('players/search?page=' . $page->before, 'Previous')); ?></td>
                        <td><?php echo $this->tag->linkTo(array('players/search?page=' . $page->next, 'Next')); ?></td>
                        <td><?php echo $this->tag->linkTo(array('players/search?page=' . $page->last, 'Last')); ?></td>
                        <td><?php echo $page->current . '/' . $page->total_pages; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    <tbody>
</table>
