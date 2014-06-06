
<?php echo $this->getContent(); ?>

<div align="right">
    <?php echo $this->tag->linkTo(array('players/new', 'Create players')); ?>
</div>

<?php echo $this->tag->form(array('players/search', 'method' => 'post', 'autocomplete' => 'off')); ?>

<div align="center">
    <h1>Search players</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="id">Id</label>
        </td>
        <td align="left">
            <?php echo $this->tag->textField(array('id', 'type' => 'numeric')); ?>
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="name">Name</label>
        </td>
        <td align="left">
            <?php echo $this->tag->textField(array('name', 'size' => 30)); ?>
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="team">Team</label>
        </td>
        <td align="left">
            <?php echo $this->tag->textField(array('team', 'type' => 'numeric')); ?>
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="position">Position</label>
        </td>
        <td align="left">
            <?php echo $this->tag->textField(array('position', 'size' => 30)); ?>
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="point">Point</label>
        </td>
        <td align="left">
            <?php echo $this->tag->textField(array('point', 'type' => 'numeric')); ?>
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="attack_point">Attack Of Point</label>
        </td>
        <td align="left">
            <?php echo $this->tag->textField(array('attack_point', 'type' => 'numeric')); ?>
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="defense_point">Defense Of Point</label>
        </td>
        <td align="left">
            <?php echo $this->tag->textField(array('defense_point', 'type' => 'numeric')); ?>
        </td>
    </tr>

    <tr>
        <td></td>
        <td><?php echo $this->tag->submitButton(array('Search')); ?></td>
    </tr>
</table>

</form>
