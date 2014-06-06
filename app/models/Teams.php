<?php




class Teams extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;
     
    /**
     *
     * @var integer
     */
    protected $team1;
     
    /**
     *
     * @var integer
     */
    protected $team2;
     
    /**
     *
     * @var integer
     */
    protected $team3;
     
    /**
     *
     * @var integer
     */
    protected $team4;
     
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
     * Method to set the value of field team1
     *
     * @param integer $team1
     * @return $this
     */
    public function setTeam1($team1)
    {
        $this->team1 = $team1;

        return $this;
    }

    /**
     * Method to set the value of field team2
     *
     * @param integer $team2
     * @return $this
     */
    public function setTeam2($team2)
    {
        $this->team2 = $team2;

        return $this;
    }

    /**
     * Method to set the value of field team3
     *
     * @param integer $team3
     * @return $this
     */
    public function setTeam3($team3)
    {
        $this->team3 = $team3;

        return $this;
    }

    /**
     * Method to set the value of field team4
     *
     * @param integer $team4
     * @return $this
     */
    public function setTeam4($team4)
    {
        $this->team4 = $team4;

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
     * Returns the value of field team1
     *
     * @return integer
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * Returns the value of field team2
     *
     * @return integer
     */
    public function getTeam2()
    {
        return $this->team2;
    }

    /**
     * Returns the value of field team3
     *
     * @return integer
     */
    public function getTeam3()
    {
        return $this->team3;
    }

    /**
     * Returns the value of field team4
     *
     * @return integer
     */
    public function getTeam4()
    {
        return $this->team4;
    }

}
