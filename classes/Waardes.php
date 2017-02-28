<?php

/**
 * Class Waardes
 */
class Waardes
{
    /**
     * @var PDO
     */
    private $db;
    /**
     * @var int
     */
    private $scan_id;
    /**
     * @var string
     */
    private $date;
    /**
     * @var string
     */
    private $location;
    /**
     * @var string
     */
    private $temperature;
    /**
     * @var int
     */
    private $moisture;
    /**
     * @var string
     */
    private $scanname;
    /**
     * @var int
     */
    private $arseenppm;
    /**
     * @var int
     */
    private $cadmiumppm;
    /**
     * @var int
     */
    private $koperppm;
    /**
     * @var int
     */
    private $kwikppm;
    /**
     * @var int
     */
    private $loodppm;
    /**
     * @var int
     */
    private $zinkppm;

    /**
     * @param int
     */
    private $lastinsertedid;

    /**
     * @param string
     */
    private $lat;

    /**
     * @param string
     */
    private $lng;

    /**
     * @var array
     */
    private $waardes_info = array();

    /**
     * @param $dbconnection
     * @param string $productID
     */
    public function __construct($dbconnection, $scan_id = null)
    {
        $this->db = $dbconnection;

        if (is_numeric($scan_id) && $scan_id != null) {
            $this->read($scan_id);
        }
    }

    /**
     *
     */
    public function create()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO waardes(locatie, temperatuur, vochtigheid, naam_scan, arseen_ppm, cadmium_ppm, koper_ppm, kwik_ppm, lood_ppm, zink_ppm)
                                    VALUES(:loca, :temp, :mois, :sname, :arsppm, :cadppm, :kopppm, :kwippm, :looppm, :zinppm)");
            $stmt->bindParam(":loca", $this->location);
            $stmt->bindParam(":temp", $this->temperature);
            $stmt->bindParam(":mois", $this->moisture);
            $stmt->bindParam(":sname", $this->scanname);
            $stmt->bindParam(":arsppm", $this->arseenppm);
            $stmt->bindParam(":cadppm", $this->cadmiumppm);
            $stmt->bindParam(":kopppm", $this->koperppm);
            $stmt->bindParam(":kwippm", $this->kwikppm);
            $stmt->bindParam(":looppm", $this->loodppm);
            $stmt->bindParam(":zinppm", $this->zinkppm);
            $stmt->execute();

        } catch (PDOException $e) {
            echo "er is iets misgegaan met het maken van het product!" . " " . $e->getMessage();
        }
    }

    /**
     *
     */
    public function scandata($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM waardes WHERE scan_id = :scanid");
        $stmt->bindParam(":scanid", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->waardes_info = $result;
    }

    /**
     * @param $id
     */
    public function read($id)
    {
        if (empty($id)) {
            throw new InvalidArgumentException('Id is geen getal');
        }

        try {
            $stmt = $this->db->prepare("
                           SELECT *
                           FROM waardes
                           WHERE waardes.scan_id = :id
                            ");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->waardes_info = $result;
                $this->scan_id = $result['scan_id'];
                $this->date = $result['datum'];
                $this->location = $result['locatie'];
                $this->temperature = $result['temperatuur'];
                $this->moisture = $result['vochtigheid'];
                $this->scanname = $result['naam_scan'];
                $this->arseenppm = $result['arseen_ppm'];
                $this->cadmiumppm = $result['cadmium_ppm'];
                $this->koperppm = $result['koper_ppm'];
                $this->kwikppm = $result['kwik_ppm'];
                $this->loodppm = $result['lood_ppm'];
                $this->zinkppm = $result['zink_ppm'];
                $this->lat = $result['latitude'];
                $this->lng = $result['longitude'];
            }

        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
        }

    }

    /**
     * @param $id
     */
    public function update($id)
    {
        if (!is_numeric($id)) {
            throw new InvalidArgumentException('id is geen getal!');
        }
        try {
            $stmt = $this->db->prepare("UPDATE waardes SET arseen_ppm = :arsppm,
                                                           cadmium_ppm = :cadppm,
                                                           koper_ppm = :kopppm,
                                                           kwik_ppm = :kwippm,
                                                           lood_ppm = :looppm,
                                                           zink_ppm = :zinppm,
                                                           WHERE id= scan_id:");
            $stmt->bindParam(":arsppm", $this->arseenppm);
            $stmt->bindParam(":cadppm", $this->cadmiumppm);
            $stmt->bindParam(":kopppm", $this->koperppm);
            $stmt->bindParam(":kwippm", $this->kwikppm);
            $stmt->bindParam(":looppm", $this->loodppm);
            $stmt->bindParam(":zinppm", $this->zinkppm);
            $stmt->bindParam(":scan_id", $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM waardes WHERE scan_id= :scanid");
        $stmt->bindParam(':scanid', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->lat;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->lng;
    }

    /**
     * @return mixed
     */
    public function getLastinsertedid()
    {
        return $this->lastinsertedid;
    }

    /**
     * @return int
     */
    public function getScanid()
    {
        return $this->scan_id;
    }

    /**
     * @param $scan_id
     */
    public function setScanid($scan_id)
    {
        $this->scan_id = htmlentities($scan_id);
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param $location
     */
    public function setLocation($location)
    {
        $this->location = htmlentities($location);
    }

    /**
 * @return string
 */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param $temperature
     */
    public function setTemperature($temperature)
    {
        $this->temperature= htmlentities($temperature);
    }

    /**
     * @return string
     */
    public function getMoisture()
    {
        return $this->moisture;
    }

    /**
     * @param $moisture
     */
    public function setMoisture($moisture)
    {
        $this->moisture= htmlentities($moisture);
    }

    /**
     * @return string
     */
    public function getScanName()
    {
        return $this->scanname;
    }

    /**
     * @param $scanname
     */
    public function setScanName($scanname)
    {
        $this->scanname= htmlentities($scanname);
    }

    /**
     * @return int
     */
    public function getArseenPpm()
    {
        return $this->arseenppm;
    }

    /**
 * @return int
 */
    public function getCadmiumPpm()
    {
        return $this->cadmiumppm;
    }

    /**
 * @return int
 */
    public function getKoperPpm()
    {
        return $this->koperppm;
    }

    /**
 * @return int
 */
    public function getKwikPpm()
    {
        return $this->kwikppm;
    }

    /**
 * @return int
 */
    public function getLoodPpm()
    {
        return $this->loodppm;
    }

    /**
 * @return int
 */
    public function getZinkPpm()
    {
        return $this->zinkppm;
    }

    /**
     * @return array
     */
    public function getProductInfo()
    {
        return $this->scan_info;
    }


    /**
     * @param int $arseenppm
     */
    public function setArseenPpm($arseenppm)
    {
        $this->arseenppm = htmlentities($arseenppm);
    }


    /**
     * @param int $arseenppm
     */
    public function setCadmiumPpm($cadmiumppm)
    {
        $this->cadmiumppm = htmlentities($cadmiumppm);
    }

    /**
     * @param int $loodppm
     */
    public function setLoodPpm($loodppm)
    {
        $this->loodppm = htmlentities($loodppm);
    }

    /**
     * @param int $koperppm
     */
    public function setKoperPpm($koperppm)
    {
        $this->koperppm = htmlentities($koperppm);
    }

    /**
     * @param int $zinkppm
     */
    public function setZinkPpm($zinkppm)
    {
            $this->zinkppm = htmlentities($zinkppm);
    }

    /**
     * @param int $kwikppm
     */
    public function setKwikPpm($kwikppm)
    {
        $this->kwikppm = htmlentities($kwikppm);
    }
}
