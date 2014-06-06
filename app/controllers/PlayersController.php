<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class PlayersController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for players
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Players", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $players = Players::find($parameters);
        if (count($players) == 0) {
            $this->flash->notice("The search did not find any players");

            return $this->dispatcher->forward(array(
                "controller" => "players",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $players,
            "limit"=> 50,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displayes the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a player
     *
     * @param string $id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $player = Players::findFirstByid($id);
            if (!$player) {
                $this->flash->error("player was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "players",
                    "action" => "index"
                ));
            }

            $this->view->id = $player->id;

            $this->tag->setDefault("id", $player->getId());
            $this->tag->setDefault("name", $player->getName());
            $this->tag->setDefault("team", $player->getTeam());
            $this->tag->setDefault("position", $player->getPosition());
            $this->tag->setDefault("point", $player->getPoint());
            $this->tag->setDefault("attack_point", $player->getAttackPoint());
            $this->tag->setDefault("defense_point", $player->getDefensePoint());
            
        }
    }

    /**
     * Creates a new player
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "players",
                "action" => "index"
            ));
        }

        $player = new Players();

        $player->setName($this->request->getPost("name"));
        $player->setTeam($this->request->getPost("team"));
        $player->setPosition($this->request->getPost("position"));
        $player->setPoint($this->request->getPost("point"));
        $player->setAttackPoint($this->request->getPost("attack_point"));
        $player->setDefensePoint($this->request->getPost("defense_point"));
        

        if (!$player->save()) {
            foreach ($player->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "players",
                "action" => "new"
            ));
        }

        $this->flash->success("player was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "players",
            "action" => "index"
        ));

    }

    /**
     * Saves a player edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "players",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $player = Players::findFirstByid($id);
        if (!$player) {
            $this->flash->error("player does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "players",
                "action" => "index"
            ));
        }

        $player->setName($this->request->getPost("name"));
        $player->setTeam($this->request->getPost("team"));
        $player->setPosition($this->request->getPost("position"));
        $player->setPoint($this->request->getPost("point"));
        $player->setAttackPoint($this->request->getPost("attack_point"));
        $player->setDefensePoint($this->request->getPost("defense_point"));
        

        if (!$player->save()) {

            foreach ($player->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "players",
                "action" => "edit",
                "params" => array($player->id)
            ));
        }

        $this->flash->success("player was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "players",
            "action" => "index"
        ));

    }

    /**
     * Deletes a player
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $player = Players::findFirstByid($id);
        if (!$player) {
            $this->flash->error("player was not found");

            return $this->dispatcher->forward(array(
                "controller" => "players",
                "action" => "index"
            ));
        }

        if (!$player->delete()) {

            foreach ($player->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "players",
                "action" => "search"
            ));
        }

        $this->flash->success("player was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "players",
            "action" => "index"
        ));
    }

    /**
     * Auto set team a player
     *
     * @param string $id
     */
    public function autoSetTeamAction($id)
    {
        $player = Players::findFirstByid($id);
        if (!$player) {
            $this->flash->error("player does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "players",
                "action" => "index"
            ));
        }

        $team = Teams::findFirstByid(1);
        if (!$team) {
            $this->flash->error("team does not exist ");

            return $this->dispatcher->forward(array(
                "controller" => "teams",
                "action" => "index"
            ));
        }

        $team_num = rand(1,4);
        $player->setTeam($team_num);
        switch ($team_num) {
            case '1':
                $current_quantity = $team->getTeam1();
                $quantity = $current_quantity + 1;
                $team->setTeam1($quantity);
                break;
            case '2':
                $current_quantity = $team->getTeam2();
                $quantity = $current_quantity + 1;
                $team->setTeam2($quantity);
                break;
            case '3':
                $current_quantity = $team->getTeam3();
                $quantity = $current_quantity + 1;
                $team->setTeam3($quantity);
                break;
            case '4':
                $current_quantity = $team->getTeam4();
                $quantity = $current_quantity + 1;
                $team->setTeam4($quantity);
                break;
            default :
                break;
        }
        

        if (!$team->save()) {
            $this->flash->error("team member was updated false");

            return $this->dispatcher->forward(array(
                "controller" => "teams",
                "action" => "index"
            ));
        } else {
            $this->flash->success("team member was updated successfully");
        }
       
        if (!$player->save()) {

            foreach ($player->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "players",
                "action" => "edit",
                "params" => array($player->id)
            ));
        }

        $this->flash->success("team player was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "players",
            "action" => "search"
        ));
    }

    /**
     * Auto set team all player
     *
     * @param string $id
     */
    public function createTeamAction() {
        $team = Teams::findFirstByid(1);

        $cb_players = Players::find(array("position='CB'", 'order' => 'point DESC'));
        
        foreach ($cb_players as $cb_player) {

            $quantity_mem_all_team = array($team->getTeam1(), $team->getTeam2(), $team->getTeam3(), $team->getTeam4());
            $quantity_min = min($quantity_mem_all_team);
            $array_key_team = array_keys($quantity_mem_all_team, $quantity_min);
            $team_num_key = array_rand($array_key_team);
            $team_num = $array_key_team[$team_num_key] + 1;
            

            $cb_player->setTeam($team_num);
            if (!$cb_player->save()) {

                foreach ($player->getMessages() as $message) {
                    $this->flash->error($message);
                }

                return $this->dispatcher->forward(array(
                    "controller" => "players",
                    "action" => "edit",
                    "params" => array($cb_player->id)
                ));
            }

            switch ($team_num) {
                case '1':
                    $current_quantity = $team->getTeam1();
                    $quantity = $current_quantity + 1;
                    $team->setTeam1($quantity);
                    break;
                case '2':
                    $current_quantity = $team->getTeam2();
                    $quantity = $current_quantity + 1;
                    $team->setTeam2($quantity);
                    break;
                case '3':
                    $current_quantity = $team->getTeam3();
                    $quantity = $current_quantity + 1;
                    $team->setTeam3($quantity);
                    break;
                case '4':
                    $current_quantity = $team->getTeam4();
                    $quantity = $current_quantity + 1;
                    $team->setTeam4($quantity);
                    break;
                default :
                    break;
            }

            if (!$team->save()) {
                $this->flash->error("All team member was updated false");

                return $this->dispatcher->forward(array(
                    "controller" => "teams",
                    "action" => "index"
                ));
            } 
            $this->flash->success("All team member was updated successfully");
        }


        $cb_players = Players::find(array("position='GK'", 'order' => 'point DESC'));
        
        foreach ($cb_players as $cb_player) {

            $quantity_mem_all_team = array($team->getTeam1(), $team->getTeam2(), $team->getTeam3(), $team->getTeam4());
            $quantity_min = min($quantity_mem_all_team);
            $array_key_team = array_keys($quantity_mem_all_team, $quantity_min);
            $team_num_key = array_rand($array_key_team);
            $team_num = $array_key_team[$team_num_key] + 1;
            

            $cb_player->setTeam($team_num);
            if (!$cb_player->save()) {

                foreach ($player->getMessages() as $message) {
                    $this->flash->error($message);
                }

                return $this->dispatcher->forward(array(
                    "controller" => "players",
                    "action" => "edit",
                    "params" => array($cb_player->id)
                ));
            }

            switch ($team_num) {
                case '1':
                    $current_quantity = $team->getTeam1();
                    $quantity = $current_quantity + 1;
                    $team->setTeam1($quantity);
                    break;
                case '2':
                    $current_quantity = $team->getTeam2();
                    $quantity = $current_quantity + 1;
                    $team->setTeam2($quantity);
                    break;
                case '3':
                    $current_quantity = $team->getTeam3();
                    $quantity = $current_quantity + 1;
                    $team->setTeam3($quantity);
                    break;
                case '4':
                    $current_quantity = $team->getTeam4();
                    $quantity = $current_quantity + 1;
                    $team->setTeam4($quantity);
                    break;
                default :
                    break;
            }

            if (!$team->save()) {
                $this->flash->error("All team member was updated false");

                return $this->dispatcher->forward(array(
                    "controller" => "teams",
                    "action" => "index"
                ));
            } 
        }

        $cb_players = Players::find(array("position='MF'", 'order' => 'point DESC'));
        
        foreach ($cb_players as $cb_player) {

            $quantity_mem_all_team = array($team->getTeam1(), $team->getTeam2(), $team->getTeam3(), $team->getTeam4());
            $quantity_min = min($quantity_mem_all_team);
            $array_key_team = array_keys($quantity_mem_all_team, $quantity_min);
            $team_num_key = array_rand($array_key_team);
            $team_num = $array_key_team[$team_num_key] + 1;
            

            $cb_player->setTeam($team_num);
            if (!$cb_player->save()) {

                foreach ($player->getMessages() as $message) {
                    $this->flash->error($message);
                }

                return $this->dispatcher->forward(array(
                    "controller" => "players",
                    "action" => "edit",
                    "params" => array($cb_player->id)
                ));
            }

            switch ($team_num) {
                case '1':
                    $current_quantity = $team->getTeam1();
                    $quantity = $current_quantity + 1;
                    $team->setTeam1($quantity);
                    break;
                case '2':
                    $current_quantity = $team->getTeam2();
                    $quantity = $current_quantity + 1;
                    $team->setTeam2($quantity);
                    break;
                case '3':
                    $current_quantity = $team->getTeam3();
                    $quantity = $current_quantity + 1;
                    $team->setTeam3($quantity);
                    break;
                case '4':
                    $current_quantity = $team->getTeam4();
                    $quantity = $current_quantity + 1;
                    $team->setTeam4($quantity);
                    break;
                default :
                    break;
            }

            if (!$team->save()) {
                $this->flash->error("All team member was updated false");

                return $this->dispatcher->forward(array(
                    "controller" => "teams",
                    "action" => "index"
                ));
            } 
        }

        $cb_players = Players::find(array("position='CF'", 'order' => 'point DESC'));
        
        foreach ($cb_players as $cb_player) {

            $quantity_mem_all_team = array($team->getTeam1(), $team->getTeam2(), $team->getTeam3(), $team->getTeam4());
            $quantity_min = min($quantity_mem_all_team);
            $array_key_team = array_keys($quantity_mem_all_team, $quantity_min);
            $team_num_key = array_rand($array_key_team);
            $team_num = $array_key_team[$team_num_key] + 1;
            

            $cb_player->setTeam($team_num);
            if (!$cb_player->save()) {

                foreach ($player->getMessages() as $message) {
                    $this->flash->error($message);
                }

                return $this->dispatcher->forward(array(
                    "controller" => "players",
                    "action" => "edit",
                    "params" => array($cb_player->id)
                ));
            }

            switch ($team_num) {
                case '1':
                    $current_quantity = $team->getTeam1();
                    $quantity = $current_quantity + 1;
                    $team->setTeam1($quantity);
                    break;
                case '2':
                    $current_quantity = $team->getTeam2();
                    $quantity = $current_quantity + 1;
                    $team->setTeam2($quantity);
                    break;
                case '3':
                    $current_quantity = $team->getTeam3();
                    $quantity = $current_quantity + 1;
                    $team->setTeam3($quantity);
                    break;
                case '4':
                    $current_quantity = $team->getTeam4();
                    $quantity = $current_quantity + 1;
                    $team->setTeam4($quantity);
                    break;
                default :
                    break;
            }

            if (!$team->save()) {
                $this->flash->error("All team member was updated false");

                return $this->dispatcher->forward(array(
                    "controller" => "teams",
                    "action" => "index"
                ));
            } 
        }

        return $this->dispatcher->forward(array(
            "controller" => "players",
            "action" => "search"
        ));
    }
}
