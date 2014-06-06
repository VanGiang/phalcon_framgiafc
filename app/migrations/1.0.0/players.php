<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class PlayersMigration_100 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'players',
            array(
            'columns' => array(
                new Column(
                    'id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 10,
                        'first' => true
                    )
                ),
                new Column(
                    'name',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 70,
                        'after' => 'id'
                    )
                ),
                new Column(
                    'team',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 4,
                        'after' => 'name'
                    )
                ),
                new Column(
                    'position',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 256,
                        'after' => 'team'
                    )
                ),
                new Column(
                    'point',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 11,
                        'after' => 'position'
                    )
                ),
                new Column(
                    'attack_point',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 11,
                        'after' => 'point'
                    )
                ),
                new Column(
                    'defense_point',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 11,
                        'after' => 'attack_point'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('id'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '1',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'latin1_swedish_ci'
            )
        )
        );
    }
}
