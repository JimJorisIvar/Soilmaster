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
    private $scanID;
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
    private $antimoonppm;
    /**
     * @var int
     */
    private $arseenppm;
    /**
     * @var int
     */
    private $bariumppm;
    /**
     * @var int
     */
    private $cadmiumppm;
    /**
     * @var int
     */
    private $chroomppm;
    /**
     * @var int
     */
    private $cobaltppm;
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
    private $molybeenppm;
    /**
     * @var int
     */
    private $nikkelppm;
    /**
     * @var int
     */
    private $zinkppm;

    /**
     * @param int
     */
    private $lastinsertedid;

    /**
     * @var array
     */
    private $waardes_info = array();

    /**
     * @param $dbconnection
     * @param string $productID
     */
    public function __construct($dbconnection, $scanID = null)
    {
        $this->db = $dbconnection;

        if (is_numeric($scanID) && $scanID != null) {
            $this->read($scanID);
        }
    }

    /**
     *
     */
    public function create()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO waardes(locatie, temperatuur, vochtigheid, naamScan, antimoonPpm,arseenPpm,bariumPpm,cadmiumPpm, chroomPpm, cobaltPpm, koperPpm, kwikPpm, loodPpm, molybeenPpm, nikkelPpm, zinkPpm)
                                    VALUES(:loca, :temp, :mois, :sname, :antppm, :arsppm, :barppm, :cadppm, :chrppm, :cobppm, :kopppm, :kwippm, :looppm, :molppm, :nikppm, :zinppm)");
            $stmt->bindParam(":loca", $this->location);
            $stmt->bindParam(":temp", $this->temperature);
            $stmt->bindParam(":mois", $this->moisture);
            $stmt->bindParam(":sname", $this->scanname);
            $stmt->bindParam(":antppm", $this->antimoonppm);
            $stmt->bindParam(":arsppm", $this->arseenppm);
            $stmt->bindParam(":barppm", $this->bariumppm);
            $stmt->bindParam(":cadppm", $this->cadmiumppm);
            $stmt->bindParam(":chrppm", $this->chroomppm);
            $stmt->bindParam(":cobppm", $this->cobaltppm);
            $stmt->bindParam(":kopppm", $this->koperppm);
            $stmt->bindParam(":kwippm", $this->kwikppm);
            $stmt->bindParam(":looppm", $this->loodppm);
            $stmt->bindParam(":molppm", $this->molybeenppm);
            $stmt->bindParam(":nikppm", $this->nikkelppm);
            $stmt->bindParam(":zinppm", $this->zinkppm);
            $stmt->execute();
            $this->lastinsertedid = $this->db->lastInsertId();

        } catch (PDOException $e) {
            echo "er is iets misgegaan met het maken van het product!" . " " . $e->getMessage();
        }
    }

    /**
     *
     */
    public function scandata($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM waardes WHERE scanID = :scanid");
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
                           WHERE waardes.scanID = :id
                            ");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->waardes_info = $result;
                $this->location = $result['locatie'];
                $this->temperature = $result['temperatuur'];
                $this->moisture = $result['vochtigheid'];
                $this->scanname = $result['naamScan'];
                $this->antimoonppm = $result['antimoonPpm'];
                $this->arseenppm = $result['arseenPpm'];
                $this->bariumppm = $result['bariumPpm'];
                $this->cadmiumppm = $result['cadmiumPpm'];
                $this->chroomppm = $result['chroomPpm'];
                $this->cobaltppm = $result['cobaltPpm'];
                $this->koperppm = $result['koperPpm'];
                $this->kwikppm = $result['kwikPpm'];
                $this->loodppm = $result['loodPpm'];
                $this->molybeenppm = $result['molybeenPpm'];
                $this->nikkelppm = $result['nikkelPpm'];
                $this->zinkppm = $result['zinkPpm'];
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
            $stmt = $this->db->prepare("UPDATE waardes SET antimoonPpm = :antppm,
                                                           arseenPpm = :arsppm,
                                                           bariumPpm = :barppm,
                                                           cadmiumPpm = :cadppm,
                                                           chroomPpm = :chrppm,
                                                           cobaltPpm = :cobppm,
                                                           koperPpm = :kopppm,
                                                           kwikPpm = :kwippm,
                                                           loodPpm = :looppm,
                                                           molybeenPpm = :molppm,
                                                           nikkelPpm = :nikppm,
                                                           zinkPpm = :zinppm,
                                                           WHERE id= scan_id:");
            $stmt->bindParam(":antppm", $this->antimoonppm);
            $stmt->bindParam(":arsppm", $this->arseenppm);
            $stmt->bindParam(":barppm", $this->bariumppm);
            $stmt->bindParam(":cadppm", $this->cadmiumppm);
            $stmt->bindParam(":chrppm", $this->chroomppm);
            $stmt->bindParam(":cobppm", $this->cobaltppm);
            $stmt->bindParam(":kopppm", $this->koperppm);
            $stmt->bindParam(":kwippm", $this->kwikppm);
            $stmt->bindParam(":looppm", $this->loodppm);
            $stmt->bindParam(":molppm", $this->molybeenppm);
            $stmt->bindParam(":nikppm", $this->nikkelppm);
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
        $stmt = $this->db->prepare("DELETE FROM waardes WHERE scanID= :scanid");
        $stmt->bindParam(':scanid', $id, PDO::PARAM_INT);
        $stmt->execute();
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
        return $this->scanID;
    }

    /**
     * @param $scanid
     */
    public function setScanid($scanid)
    {
        $this->scanID = htmlentities($scanid);
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
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
    public function getAntimoonPpm()
    {
        return $this->antimoonppm;
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
    public function getBariumPpm()
    {
        return $this->bariumppm;
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
    public function getChroomPpm()
    {
        return $this->chroomppm;
    }

    /**
 * @return int
 */
    public function getCobaltPpm()
    {
        return $this->cobaltppm;
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
    public function getMolybeenPpm()
    {
        return $this->molybeenppm;
    }

    /**
 * @return int
 */
    public function getNikkelPpm()
    {
        return $this->nikkelppm;
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
     * @param int $antimoonppm
     */
    public function setAntimoonPpm($antimoonppm)
    {
        $this->antimoonppm = htmlentities($antimoonppm);
    }

    /**
     * @param int $arseenppm
     */
    public function setArseenPpm($arseenppm)
    {
        $this->arseenppm = htmlentities($arseenppm);
    }

    /**
     * @param int $bariumppm
     */
    public function setBariumPpm($bariumppm)
    {
        $this->bariumppm = htmlentities($bariumppm);
    }

    /**
     * @param int $arseenppm
     */
    public function setCadmiumPpm($cadmiumppm)
    {
        $this->cadmiumppm = htmlentities($cadmiumppm);
    }
}
