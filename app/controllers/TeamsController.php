<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class TeamsController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for teams
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Teams", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $teams = Teams::find($parameters);
        if (count($teams) == 0) {
            $this->flash->notice("The search did not find any teams");

            return $this->dispatcher->forward(array(
                "controller" => "teams",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $teams,
            "limit"=> 10,
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
     * Edits a team
     *
     * @param string $id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $team = Teams::findFirstByid($id);
            if (!$team) {
                $this->flash->error("team was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "teams",
                    "action" => "index"
                ));
            }

            $this->view->id = $team->id;

            $this->tag->setDefault("id", $team->getId());
            $this->tag->setDefault("team1", $team->getTeam1());
            $this->tag->setDefault("team2", $team->getTeam2());
            $this->tag->setDefault("team3", $team->getTeam3());
            $this->tag->setDefault("team4", $team->getTeam4());
            
        }
    }

    /**
     * Creates a new team
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "teams",
                "action" => "index"
            ));
        }

        $team = new Teams();

        $team->setTeam1($this->request->getPost("team1"));
        $team->setTeam2($this->request->getPost("team2"));
        $team->setTeam3($this->request->getPost("team3"));
        $team->setTeam4($this->request->getPost("team4"));
        

        if (!$team->save()) {
            foreach ($team->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "teams",
                "action" => "new"
            ));
        }

        $this->flash->success("team was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "teams",
            "action" => "index"
        ));

    }

    /**
     * Saves a team edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "teams",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $team = Teams::findFirstByid($id);
        if (!$team) {
            $this->flash->error("team does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "teams",
                "action" => "index"
            ));
        }

        $team->setTeam1($this->request->getPost("team1"));
        $team->setTeam2($this->request->getPost("team2"));
        $team->setTeam3($this->request->getPost("team3"));
        $team->setTeam4($this->request->getPost("team4"));
        

        if (!$team->save()) {

            foreach ($team->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "teams",
                "action" => "edit",
                "params" => array($team->id)
            ));
        }

        $this->flash->success("team was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "teams",
            "action" => "index"
        ));

    }

    /**
     * Deletes a team
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $team = Teams::findFirstByid($id);
        if (!$team) {
            $this->flash->error("team was not found");

            return $this->dispatcher->forward(array(
                "controller" => "teams",
                "action" => "index"
            ));
        }

        if (!$team->delete()) {

            foreach ($team->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "teams",
                "action" => "search"
            ));
        }

        $this->flash->success("team was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "teams",
            "action" => "index"
        ));
    }

}
