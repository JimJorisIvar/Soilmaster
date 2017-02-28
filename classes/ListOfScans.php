<?php

class ListOfScans
{
    /**
     * @var array
     */
    private $listofscans = array();

    /**
     * @var PDO
     */
    private $db;

    function __construct($dbconnection)
    {
        $this->db = $dbconnection; // moet nog error handling bij

        try
        {
            $stmt = $this->db->prepare("SELECT * FROM waardes ORDER BY scan_id");
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->listofscans[] = new Waardes($this->db, $result['scan_id']);
            }

        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }

    }
    /**
     * @return Waardes[]
     */
    function getListOfScans()
    {
        return $this->listofscans;
    }
}