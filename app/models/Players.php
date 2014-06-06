<?php




class Players extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;
     
    /**
     *
     * @var string
     */
    protected $name;
     
    /**
     *
     * @var integer
     */
    protected $team;
     
    /**
     *
     * @var string
     */
    protected $position;
     
    /**
     *
     * @var integer
     */
    protected $point;
     
    /**
     *
     * @var integer
     */
    protected $attack_point;
     
    /**
     *
     * @var integer
     */
    protected $defense_point;
     
    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field team
     *
     * @param integer $team
     * @return $this
     */
    public function setTeam($team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Method to set the value of field position
     *
     * @param string $position
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Method to set the value of field point
     *
     * @param integer $point
     * @return $this
     */
    public function setPoint($point)
    {
        $this->point = $point;

        return $this;
    }

    /**
     * Method to set the value of field attack_point
     *
     * @param integer $attack_point
     * @return $this
     */
    public function setAttackPoint($attack_point)
    {
        $this->attack_point = $attack_point;

        return $this;
    }

    /**
     * Method to set the value of field defense_point
     *
     * @param integer $defense_point
     * @return $this
     */
    public function setDefensePoint($defense_point)
    {
        $this->defense_point = $defense_point;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field team
     *
     * @return integer
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Returns the value of field position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Returns the value of field point
     *
     * @return integer
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Returns the value of field attack_point
     *
     * @return integer
     */
    public function getAttackPoint()
    {
        return $this->attack_point;
    }

    /**
     * Returns the value of field defense_point
     *
     * @return integer
     */
    public function getDefensePoint()
    {
        return $this->defense_point;
    }

}
